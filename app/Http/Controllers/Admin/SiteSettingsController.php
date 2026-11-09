<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlatformSetting;
use App\Services\SiteSettings;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SiteSettingsController extends Controller
{
    public function __construct(private readonly SiteSettings $settings)
    {
    }

    public function general()
    {
        $this->ensureAdmin();

        return view('admin.settings.general', [
            'settings' => $this->settings->all(),
            'razorpay' => [
                'key_id' => config('services.razorpay.key_id'),
                'configured' => filled(config('services.razorpay.key_id')) && filled(config('services.razorpay.key_secret')),
                'webhook_configured' => filled(config('services.razorpay.webhook_secret')),
            ],
        ]);
    }

    public function updateGeneral(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'site_name' => 'required|string|max:100',
            'website_tagline' => 'nullable|string|max:150',
            'website_url' => 'nullable|url|max:255',
            'website_description' => 'nullable|string|max:1000',
            'support_email' => 'nullable|email|max:150',
            'contact_phone' => 'nullable|string|max:30',
            'contact_address' => 'nullable|string|max:500',
            'copyright_text' => 'nullable|string|max:255',
            'default_language' => 'nullable|string|max:10',
            'timezone' => 'nullable|timezone',
            'commission_rate' => 'required|numeric|min:0|max:100',
            'maintenance_mode' => 'nullable|boolean',
        ]);

        $map = [
            'site_name' => 'site_name',
            'website_tagline' => 'website_tagline',
            'website_url' => 'website_url',
            'website_description' => 'website_description',
            'support_email' => 'support_email',
            'contact_phone' => 'contact_phone',
            'contact_address' => 'contact_address',
            'copyright_text' => 'copyright_text',
            'default_language' => 'default_language',
            'timezone' => 'timezone',
            'commission_rate' => 'commission_rate',
        ];

        $values = [];
        foreach ($map as $key => $field) {
            if ($request->exists($field)) {
                $values[$key] = isset($validated[$field]) ? (string) $validated[$field] : null;
            }
        }

        $values['maintenance_mode'] = $request->boolean('maintenance_mode') ? '1' : '0';

        $this->settings->setMany($values, 'general');

        $this->audit('General settings updated', array_keys($values));

        return back()->with('success', 'General settings saved successfully.');
    }

    public function branding()
    {
        $this->ensureAdmin();

        return view('admin.settings.branding', [
            'settings' => $this->settings->all(),
            'branding' => $this->settings->branding(),
        ]);
    }

    public function updateBranding(Request $request)
    {
        $this->ensureAdmin();

        $request->validate([
            'logo' => $this->imageRule('svg'),
            'logo_dark' => $this->imageRule('svg'),
            'logo_mobile' => $this->imageRule('svg'),
            'favicon_png' => 'nullable|file|max:1024|mimetypes:image/png',
            'favicon_ico' => 'nullable|file|max:1024|mimetypes:image/x-icon,image/vnd.microsoft.icon,image/png',
            'apple_touch_icon' => 'nullable|file|max:2048|mimetypes:image/png',
            'social_image' => 'nullable|file|max:4096|mimetypes:image/png,image/jpeg,image/webp',
            'remove' => 'nullable|array',
            'remove.*' => 'string|in:logo,logo_dark,logo_mobile,favicon_png,favicon_ico,apple_touch_icon,social_image',
            'reset_branding' => 'nullable|boolean',
        ]);

        if ($request->boolean('reset_branding')) {
            $this->resetBrandingFiles();

            return back()->with('success', 'Branding was reset to the default RoomDekho assets.');
        }

        foreach ((array) $request->input('remove', []) as $key) {
            $this->deleteStoredFile($key);
            $this->settings->set($key, '', 'branding');
        }

        $fields = [
            'logo' => 'branding',
            'logo_dark' => 'branding',
            'logo_mobile' => 'branding',
            'favicon_png' => 'branding',
            'favicon_ico' => 'branding',
            'apple_touch_icon' => 'branding',
            'social_image' => 'seo',
        ];

        foreach ($fields as $field => $prefix) {
            if ($request->hasFile($field)) {
                $path = $this->storeUpload($request, $field, $prefix, $field === 'logo' || str_ends_with($field, '_dark') || str_ends_with($field, '_mobile'));
                $this->deleteStoredFile($field);
                $this->settings->set($field, $path, $prefix === 'seo' ? 'seo' : 'branding');
                $this->audit('Branding asset updated', [$field]);
            }
        }

        $this->settings->flush();

        return back()->with('success', 'Branding settings saved successfully.');
    }

    public function pwa()
    {
        $this->ensureAdmin();

        return view('admin.settings.pwa', [
            'settings' => $this->settings->all(),
            'pwa' => $this->settings->pwa(),
        ]);
    }

    public function updatePwa(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'pwa_enabled' => 'nullable|boolean',
            'pwa_name' => 'required|string|max:100',
            'pwa_short_name' => 'required|string|max:32',
            'pwa_description' => 'nullable|string|max:500',
            'pwa_theme_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'pwa_background_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'pwa_start_url' => ['required', 'string', 'max:255', function ($attribute, $value, $fail) {
                if (! str_starts_with((string) $value, '/') || str_starts_with((string) $value, '//')) {
                    $fail('The start URL must be an internal path beginning with /.');
                }
            }],
            'pwa_display' => 'required|in:standalone,fullscreen,minimal-ui,browser',
            'pwa_orientation' => 'required|in:portrait,landscape,any',
            'pwa_icon_192' => 'nullable|file|max:1024|mimetypes:image/png',
            'pwa_icon_512' => 'nullable|file|max:2048|mimetypes:image/png',
            'pwa_maskable_icon' => 'nullable|file|max:2048|mimetypes:image/png',
            'remove' => 'nullable|array',
            'remove.*' => 'string|in:pwa_icon_192,pwa_icon_512,pwa_maskable_icon',
        ]);

        $this->assertDimensions($request, 'pwa_icon_192', 192);
        $this->assertDimensions($request, 'pwa_icon_512', 512);
        $this->assertDimensions($request, 'pwa_maskable_icon', 512);

        $version = ((int) $this->settings->get('pwa_version', '1')) + 1;

        $values = [
            'pwa_enabled' => $request->boolean('pwa_enabled') ? '1' : '0',
            'pwa_name' => $validated['pwa_name'],
            'pwa_short_name' => $validated['pwa_short_name'],
            'pwa_description' => $validated['pwa_description'] ?? null,
            'pwa_theme_color' => strtoupper($validated['pwa_theme_color']),
            'pwa_background_color' => strtoupper($validated['pwa_background_color']),
            'pwa_start_url' => $validated['pwa_start_url'],
            'pwa_display' => $validated['pwa_display'],
            'pwa_orientation' => $validated['pwa_orientation'],
            'pwa_version' => (string) $version,
        ];

        foreach ((array) $request->input('remove', []) as $key) {
            $this->deleteStoredFile($key);
            $values[$key] = '';
        }

        foreach (['pwa_icon_192', 'pwa_icon_512', 'pwa_maskable_icon'] as $field) {
            if ($request->hasFile($field)) {
                $path = $this->storeUpload($request, $field, 'pwa', false);
                $this->deleteStoredFile($field);
                $values[$field] = $path;
            }
        }

        $this->settings->setMany($values, 'pwa');
        $this->audit('PWA settings updated', array_keys($values));

        return back()->with('success', 'PWA settings saved. The manifest has been refreshed.');
    }

    public function appearance()
    {
        $this->ensureAdmin();

        return view('admin.settings.appearance', [
            'settings' => $this->settings->all(),
            'appearance' => $this->settings->appearance(),
        ]);
    }

    public function updateAppearance(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'primary_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'secondary_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'accent_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'header_background' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'footer_background' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'button_style' => 'required|in:rounded,pill,square',
            'theme' => 'required|in:light,dark',
        ]);

        $this->settings->setMany($validated, 'appearance');
        $this->audit('Appearance settings updated', array_keys($validated));

        return back()->with('success', 'Appearance settings saved successfully.');
    }

    public function seo()
    {
        $this->ensureAdmin();

        return view('admin.settings.seo', [
            'settings' => $this->settings->all(),
            'branding' => $this->settings->branding(),
            'seo' => $this->settings->seo(),
        ]);
    }

    public function updateSeo(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
            'seo_keywords' => 'nullable|string|max:500',
            'seo_og_image' => 'nullable|file|max:4096|mimetypes:image/png,image/jpeg,image/webp',
            'social_image' => 'nullable|file|max:4096|mimetypes:image/png,image/jpeg,image/webp',
            'remove' => 'nullable|array',
            'remove.*' => 'string|in:seo_og_image,social_image',
            'seo_twitter_card' => ['required', Rule::in(['summary', 'summary_large_image'])],
            // Values contain commas, so Rule::in() is required: the string
            // "in:index,follow" rule would split them into separate options.
            'seo_robots' => ['required', Rule::in(['index,follow', 'noindex,nofollow'])],
        ]);

        $values = [
            'seo_title' => $validated['seo_title'] ?? null,
            'seo_description' => $validated['seo_description'] ?? null,
            'seo_keywords' => $validated['seo_keywords'] ?? null,
            'seo_twitter_card' => $validated['seo_twitter_card'],
            'seo_robots' => $validated['seo_robots'],
        ];

        foreach ((array) $request->input('remove', []) as $key) {
            $this->deleteStoredFile($key);
            $values[$key] = '';
        }

        if ($request->hasFile('seo_og_image')) {
            $path = $this->storeUpload($request, 'seo_og_image', 'seo', false);
            $this->deleteStoredFile('seo_og_image');
            $values['seo_og_image'] = $path;
        }

        if ($request->hasFile('social_image')) {
            $path = $this->storeUpload($request, 'social_image', 'seo', false);
            $this->deleteStoredFile('social_image');
            $values['social_image'] = $path;
        }

        $this->settings->setMany($values, 'seo');
        $this->audit('SEO settings updated', array_keys($values));

        return back()->with('success', 'SEO settings saved successfully.');
    }

    private function ensureAdmin(): void
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
    }

    private function imageRule(bool $allowSvg = false): array
    {
        return [
            'nullable',
            'file',
            'max:2048',
            function (string $attribute, mixed $value, \Closure $fail) use ($allowSvg) {
                if (! $value instanceof UploadedFile) {
                    return;
                }

                $extension = strtolower($value->getClientOriginalExtension());
                $allowed = $allowSvg ? ['png', 'jpg', 'jpeg', 'webp', 'svg'] : ['png', 'jpg', 'jpeg', 'webp'];

                if (! in_array($extension, $allowed, true)) {
                    $fail('Please upload a PNG, JPG, WebP' . ($allowSvg ? ' or SVG' : '') . ' file.');
                    return;
                }

                if ($extension !== 'svg' && ! in_array((string) $value->getMimeType(), ['image/png', 'image/jpeg', 'image/webp'], true)) {
                    $fail('The uploaded file is not a valid image.');
                }
            },
        ];
    }

    private function storeUpload(Request $request, string $field, string $prefix, bool $allowSvg): string
    {
        /** @var UploadedFile $file */
        $file = $request->file($field);
        $mime = (string) $file->getMimeType();

        if ($mime === 'image/svg+xml' || strtolower($file->getClientOriginalExtension()) === 'svg') {
            if (! $allowSvg) {
                throw ValidationException::withMessages([$field => 'SVG files are not allowed for this asset.']);
            }

            $sanitized = $this->sanitizeSvg((string) file_get_contents($file->getRealPath()));
            $path = 'settings/' . $prefix . '/' . $field . '-' . now()->format('YmdHis') . '-' . bin2hex(random_bytes(4)) . '.svg';
            Storage::disk('public')->put($path, $sanitized);

            return $path;
        }

        if (strtolower($file->getClientOriginalExtension()) === 'ico' || $mime === 'image/x-icon' || $mime === 'image/vnd.microsoft.icon') {
            $path = 'settings/' . $prefix . '/' . $field . '-' . now()->format('YmdHis') . '-' . bin2hex(random_bytes(4)) . '.ico';
            Storage::disk('public')->putFileAs(dirname($path), $file, basename($path));

            return $path;
        }

        return $file->store('settings/' . $prefix, 'public');
    }

    private function assertDimensions(Request $request, string $field, int $expected): void
    {
        if (! $request->hasFile($field)) {
            return;
        }

        $size = @getimagesize($request->file($field)->getRealPath());

        if (! $size || (int) $size[0] !== $expected || (int) $size[1] !== $expected) {
            throw ValidationException::withMessages([
                $field => "The {$field} image must be exactly {$expected}×{$expected} pixels.",
            ]);
        }
    }

    /**
     * Strip executable/external content from uploaded SVG files.
     */
    private function sanitizeSvg(string $svg): string
    {
        if (stripos($svg, '<svg') === false || stripos($svg, '<?php') !== false) {
            throw ValidationException::withMessages(['logo' => 'The uploaded SVG file is not a valid image.']);
        }

        if (! class_exists(DOMDocument::class)) {
            $clean = preg_replace('/<(script|foreignObject|iframe|embed|object|style)[^>]*>.*?<\/\1>/is', '', $svg) ?? '';
            $clean = preg_replace('/\son\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $clean) ?? '';
            $clean = preg_replace('/(href|xlink:href)\s*=\s*("|\')(?!data:image\/|#)[^"\']*\2/i', '', $clean) ?? '';

            return $clean;
        }

        $previous = libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $loaded = $dom->loadXML($svg, LIBXML_NONET);
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        if (! $loaded || ! $dom->documentElement || strtolower($dom->documentElement->nodeName) !== 'svg') {
            throw ValidationException::withMessages(['logo' => 'The uploaded SVG file is not a valid image.']);
        }

        foreach (['script', 'foreignObject', 'iframe', 'embed', 'object'] as $tag) {
            $nodes = $dom->getElementsByTagName($tag);
            while ($nodes->length > 0) {
                $node = $nodes->item(0);
                $node->parentNode?->removeChild($node);
            }
        }

        $xpath = new \DOMXPath($dom);
        foreach ($xpath->query('//*[@*]') ?: [] as $element) {
            $remove = [];
            foreach ($element->attributes as $attribute) {
                $name = strtolower($attribute->nodeName);
                $value = trim($attribute->nodeValue);

                if (str_starts_with($name, 'on')) {
                    $remove[] = $attribute->nodeName;
                } elseif (in_array($name, ['href', 'xlink:href'], true)
                    && ! str_starts_with($value, '#')
                    && ! str_starts_with(strtolower($value), 'data:image/')) {
                    $remove[] = $attribute->nodeName;
                } elseif ($name === 'style' && preg_match('/url\s*\(\s*["\']?(?!data:image\/)/i', $value)) {
                    $remove[] = $attribute->nodeName;
                }
            }

            foreach ($remove as $attributeName) {
                $element->removeAttribute($attributeName);
            }
        }

        return (string) $dom->saveXML();
    }

    private function deleteStoredFile(string $key): void
    {
        $path = $this->settings->get($key);

        if (! $path || str_starts_with($path, 'http')) {
            return;
        }

        if (str_starts_with($path, 'settings/') && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private function resetBrandingFiles(): void
    {
        foreach (['logo', 'logo_dark', 'logo_mobile', 'favicon_png', 'favicon_ico', 'apple_touch_icon', 'social_image'] as $key) {
            $this->deleteStoredFile($key);
            $this->settings->set($key, '', 'branding');
        }

        $this->settings->flush();
        $this->audit('Branding reset to defaults', ['logo', 'favicon', 'social_image']);
    }

    /** @param list<string> $keys */
    private function audit(string $message, array $keys): void
    {
        Log::info('RoomDekho settings: ' . $message, [
            'admin_id' => auth()->id(),
            'keys' => $keys,
            'ip' => request()->ip(),
        ]);
    }
}
