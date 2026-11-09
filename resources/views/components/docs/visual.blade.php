@props(['type'])

<svg class="doc-visual" viewBox="0 0 260 132" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
    <rect x="10" y="8" width="240" height="116" rx="18" fill="#FFFFFF" fill-opacity=".74" stroke="#EFEAF9"/>

    @switch($type)
        {{-- ---------------------------------------------------------------
             TENANT
        --------------------------------------------------------------- --}}
        @case('account')
            <circle cx="52" cy="46" r="17" fill="#EDE7FF"/>
            <circle cx="52" cy="40" r="6" fill="#8B5CF6"/>
            <path d="M41 57c2.5-7.5 19.5-7.5 22 0" fill="#8B5CF6" fill-opacity=".55"/>
            <rect x="84" y="28" width="82" height="7" rx="3.5" fill="#CDC5E3"/>
            <rect x="84" y="44" width="128" height="6" rx="3" fill="#ECE8F7"/>
            <rect x="84" y="57" width="104" height="6" rx="3" fill="#ECE8F7"/>
            <rect x="84" y="76" width="48" height="18" rx="9" fill="#F2EDFF" stroke="#E5DCFB"/>
            <rect x="140" y="76" width="48" height="18" rx="9" fill="#F7F3FF" stroke="#ECE6FA"/>
            <g class="v-pop" style="animation-delay:.45s">
                <circle cx="205" cy="99" r="15" fill="#10B981"/>
                <path d="M197.5 99l5 5 8.5-9.5" stroke="#fff" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
        @break

        @case('login')
            <path d="M60 26l26-10 26 10v28c0 20-13 34-26 40-13-6-26-20-26-40V26z" fill="#F1ECFF" stroke="#C9B8F5" stroke-width="1.5"/>
            <rect x="76" y="47" width="20" height="17" rx="5" fill="#8B5CF6"/>
            <path d="M81 47v-5a5 5 0 0110 0v5" stroke="#8B5CF6" stroke-width="2.4" stroke-linecap="round"/>
            <circle cx="86" cy="55" r="2.4" fill="#fff"/>
            <g class="v-pulse">
                <circle cx="148" cy="66" r="20" fill="#8B5CF6" fill-opacity=".1"/>
                <path d="M140 66l5.5 5.5L153 59" stroke="#8B5CF6" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <rect x="176" y="46" width="50" height="7" rx="3.5" fill="#D4CBEA"/>
            <rect x="176" y="60" width="38" height="6" rx="3" fill="#ECE8F7"/>
            <circle cx="206" cy="88" r="10" fill="#FDF2F8" stroke="#F9D6E7"/>
            <path d="M201 88h10M206 83v10" stroke="#F472B6" stroke-width="2" stroke-linecap="round"/>
        @break

        @case('search')
            <rect x="24" y="22" width="136" height="88" rx="13" fill="#F3F0FC"/>
            <path d="M24 50h136M24 78h136M62 22v88M106 22v88" stroke="#E4DDF5" stroke-width="1"/>
            <path d="M38 96c22-24 25-6 44-31 14-19 28 3 44-18" stroke="#8B5CF6" stroke-width="2" stroke-linecap="round" stroke-dasharray="4 5" class="v-draw"/>
            <g class="v-float">
                <path d="M112 38c-9.4 0-17 7.6-17 17 0 12.8 17 30 17 30s17-17.2 17-30c0-9.4-7.6-17-17-17z" fill="#F472B6"/>
                <circle cx="112" cy="55" r="6" fill="#fff"/>
            </g>
            <g class="v-pop" style="animation-delay:.4s">
                <rect x="172" y="42" width="66" height="62" rx="10" fill="#fff" stroke="#E9E3F7"/>
                <rect x="178" y="48" width="54" height="22" rx="6" fill="#EAF2FF"/>
                <path d="M186 64l9-10 7 7 6-5 12 8v6h-34z" fill="#93C5FD"/>
                <rect x="178" y="76" width="34" height="5" rx="2.5" fill="#D8D2E8"/>
                <rect x="178" y="86" width="24" height="5" rx="2.5" fill="#ECE8F7"/>
                <text x="214" y="90" fill="#6D4BD8" font-size="8" font-weight="800">₹8k</text>
            </g>
            <g class="v-pulse" style="animation-delay:.2s">
                <circle cx="205" cy="28" r="9" fill="#8B5CF6"/>
                <circle cx="202" cy="25" r="3.2" stroke="#fff" stroke-width="1.8"/>
                <path d="M204.5 27.5l4 4" stroke="#fff" stroke-width="1.8" stroke-linecap="round"/>
            </g>
        @break

        @case('filters')
            <rect x="34" y="28" width="82" height="8" rx="4" fill="#D9D2EB"/>
            <circle cx="88" cy="32" r="8" fill="#8B5CF6" class="v-slide"/>
            <rect x="34" y="56" width="82" height="8" rx="4" fill="#D9D2EB"/>
            <circle cx="58" cy="60" r="8" fill="#F472B6" class="v-slide" style="animation-delay:.4s"/>
            <rect x="34" y="84" width="82" height="8" rx="4" fill="#D9D2EB"/>
            <circle cx="102" cy="88" r="8" fill="#60A5FA" class="v-slide" style="animation-delay:.8s"/>
            <rect x="140" y="26" width="86" height="72" rx="11" fill="#fff" stroke="#E9E3F7"/>
            <rect x="148" y="36" width="38" height="5" rx="2.5" fill="#D8D2E8"/>
            <rect x="148" y="48" width="64" height="18" rx="6" fill="#F3EFFF"/>
            <rect x="154" y="54" width="30" height="5" rx="2.5" fill="#B9A7EA"/>
            <rect x="148" y="72" width="64" height="16" rx="6" fill="#FDF2F8"/>
            <rect x="154" y="78" width="38" height="5" rx="2.5" fill="#F0A3CD"/>
            <g class="v-pop" style="animation-delay:.6s">
                <circle cx="214" cy="98" r="11" fill="#10B981"/>
                <path d="M209 98l3.5 3.5 6-7" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
        @break

        @case('details')
            <rect x="30" y="22" width="132" height="88" rx="13" fill="#fff" stroke="#E9E3F7"/>
            <rect x="38" y="30" width="116" height="42" rx="8" fill="#EAF2FF"/>
            <path d="M46 66l18-22 13 14 10-9 22 17v2H46z" fill="#93C5FD"/>
            <circle cx="136" cy="42" r="5" fill="#FDE68A"/>
            <rect x="38" y="80" width="58" height="6" rx="3" fill="#D8D2E8"/>
            <rect x="38" y="92" width="40" height="5" rx="2.5" fill="#ECE8F7"/>
            <rect x="174" y="30" width="58" height="24" rx="8" fill="#F3EFFF" stroke="#E5DCFB"/>
            <text x="184" y="47" fill="#6D4BD8" font-size="11" font-weight="800">₹8,500</text>
            <rect x="174" y="64" width="58" height="18" rx="7" fill="#FBF7FF"/>
            <circle cx="185" cy="73" r="3" fill="#8B5CF6" class="v-blink"/>
            <rect x="192" y="70" width="30" height="5" rx="2.5" fill="#D8D2E8"/>
            <rect x="174" y="88" width="26" height="16" rx="5" fill="#EAF2FF"/>
            <rect x="205" y="88" width="26" height="16" rx="5" fill="#FDF2F8"/>
        @break

        @case('save')
            <rect x="58" y="22" width="104" height="88" rx="13" fill="#fff" stroke="#E9E3F7"/>
            <rect x="66" y="30" width="88" height="39" rx="8" fill="#F3F0FC"/>
            <path d="M74 62l17-20 12 13 9-8 20 15v1H74z" fill="#C4B5FD"/>
            <rect x="66" y="78" width="55" height="6" rx="3" fill="#D8D2E8"/>
            <rect x="66" y="90" width="36" height="5" rx="2.5" fill="#ECE8F7"/>
            <g class="v-heart">
                <path d="M152 34c-5.5-5.6-15-1.5-15 5.5 0 7.6 15 16.5 15 16.5s15-8.9 15-16.5c0-7-9.5-11.1-15-5.5z" fill="#F472B6"/>
            </g>
            <g class="v-float" style="animation-delay:.3s">
                <circle cx="196" cy="88" r="17" fill="#F3EFFF" stroke="#E5DCFB"/>
                <path d="M189 88l5 5 9-10" stroke="#8B5CF6" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
        @break

        @case('compare')
            <rect x="26" y="30" width="82" height="74" rx="11" fill="#fff" stroke="#E9E3F7"/>
            <rect x="34" y="38" width="66" height="27" rx="6" fill="#EAF2FF"/>
            <rect x="34" y="72" width="46" height="5" rx="2.5" fill="#D8D2E8"/>
            <rect x="34" y="83" width="30" height="5" rx="2.5" fill="#ECE8F7"/>
            <rect x="152" y="30" width="82" height="74" rx="11" fill="#fff" stroke="#E9E3F7"/>
            <rect x="160" y="38" width="66" height="27" rx="6" fill="#FDF2F8"/>
            <rect x="160" y="72" width="46" height="5" rx="2.5" fill="#D8D2E8"/>
            <rect x="160" y="83" width="30" height="5" rx="2.5" fill="#ECE8F7"/>
            <g class="v-pop" style="animation-delay:.3s">
                <circle cx="130" cy="67" r="18" fill="#8B5CF6"/>
                <path d="M123 67l4.5 4.5L139 59" stroke="#fff" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <circle cx="40" cy="22" r="7" fill="#10B981" fill-opacity=".18"/>
            <circle cx="220" cy="22" r="7" fill="#F472B6" fill-opacity=".18"/>
        @break

        @case('contact')
            <circle cx="46" cy="60" r="17" fill="#EDE7FF"/>
            <circle cx="46" cy="54" r="6" fill="#8B5CF6"/>
            <path d="M35 71c2.5-7.5 19.5-7.5 22 0" fill="#8B5CF6" fill-opacity=".55"/>
            <g class="v-slide">
                <rect x="78" y="38" width="92" height="42" rx="12" fill="#F3EFFF" stroke="#E1D6FB"/>
                <path d="M98 80l-8 12 20-12z" fill="#F3EFFF" stroke="#E1D6FB"/>
                <rect x="90" y="50" width="62" height="5" rx="2.5" fill="#C9B8F5"/>
                <rect x="90" y="61" width="42" height="5" rx="2.5" fill="#DCD5EE"/>
            </g>
            <circle cx="204" cy="58" r="17" fill="#FDF2F8"/>
            <circle cx="204" cy="52" r="6" fill="#F472B6"/>
            <path d="M193 69c2.5-7.5 19.5-7.5 22 0" fill="#F472B6" fill-opacity=".5"/>
            <g class="v-pop" style="animation-delay:.6s">
                <circle cx="207" cy="96" r="11" fill="#10B981"/>
                <path d="M202 96l3.5 3.5 6-7" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
        @break

        @case('chat')
            <rect x="32" y="28" width="108" height="38" rx="12" fill="#F3EFFF" stroke="#E1D6FB"/>
            <rect x="44" y="39" width="62" height="5" rx="2.5" fill="#C9B8F5"/>
            <rect x="44" y="50" width="42" height="5" rx="2.5" fill="#DCD5EE"/>
            <rect x="120" y="76" width="108" height="36" rx="12" fill="#FDF2F8" stroke="#F7D6E6"/>
            <rect x="132" y="86" width="60" height="5" rx="2.5" fill="#F0A3CD"/>
            <rect x="132" y="97" width="38" height="5" rx="2.5" fill="#F8D7E5"/>
            <g class="v-blink">
                <circle cx="212" cy="98" r="3" fill="#F472B6"/>
                <circle cx="222" cy="98" r="3" fill="#F472B6" style="animation-delay:.2s"/>
                <circle cx="232" cy="98" r="3" fill="#F472B6" style="animation-delay:.4s"/>
            </g>
            <circle cx="206" cy="40" r="15" fill="#EDE7FF"/>
            <circle cx="206" cy="35" r="5" fill="#8B5CF6"/>
            <path d="M197 50c2-6 16-6 18 0" fill="#8B5CF6" fill-opacity=".5"/>
        @break

        @case('visit')
            <rect x="34" y="24" width="112" height="88" rx="12" fill="#fff" stroke="#E9E3F7"/>
            <rect x="34" y="24" width="112" height="24" rx="12" fill="#F3EFFF"/>
            <rect x="34" y="38" width="112" height="10" fill="#F3EFFF"/>
            <rect x="48" y="57" width="16" height="13" rx="3" fill="#F1ECFC"/>
            <rect x="72" y="57" width="16" height="13" rx="3" fill="#F1ECFC"/>
            <rect x="96" y="57" width="16" height="13" rx="3" fill="#8B5CF6" class="v-pulse"/>
            <rect x="120" y="57" width="16" height="13" rx="3" fill="#F1ECFC"/>
            <rect x="48" y="78" width="16" height="13" rx="3" fill="#F1ECFC"/>
            <rect x="72" y="78" width="16" height="13" rx="3" fill="#F1ECFC"/>
            <rect x="96" y="78" width="16" height="13" rx="3" fill="#F1ECFC"/>
            <rect x="120" y="78" width="16" height="13" rx="3" fill="#F1ECFC"/>
            <g class="v-float">
                <circle cx="190" cy="61" r="24" fill="#F3EFFF" stroke="#E1D6FB"/>
                <circle cx="190" cy="61" r="18" fill="#fff"/>
                <path d="M190 61V49M190 61l9 6" stroke="#8B5CF6" stroke-width="2.5" stroke-linecap="round"/>
                <circle cx="190" cy="61" r="2.5" fill="#F472B6"/>
            </g>
            <g class="v-pop" style="animation-delay:.5s">
                <circle cx="211" cy="88" r="10" fill="#10B981"/>
                <path d="M206.5 88l3 3 5-6" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
        @break

        @case('booking')
            <circle cx="40" cy="66" r="15" fill="#EDE7FF"/>
            <circle cx="40" cy="61" r="5" fill="#8B5CF6"/>
            <path d="M31 75c2-6 16-6 18 0" fill="#8B5CF6" fill-opacity=".5"/>
            <path d="M62 66h82c16 0 24-9 36-9" stroke="#8B5CF6" stroke-width="2" stroke-linecap="round" stroke-dasharray="5 6" class="v-draw"/>
            <g class="v-slide">
                <rect x="88" y="48" width="32" height="24" rx="5" fill="#F3EFFF" stroke="#D9CBF8"/>
                <path d="M88 51l16 12 16-12" stroke="#A78BFA" stroke-width="2" stroke-linejoin="round"/>
            </g>
            <circle cx="202" cy="57" r="16" fill="#FDF2F8"/>
            <path d="M202 44l3 8 8 .5-6 5 2 8-7-4-7 4 2-8-6-5 8-.5z" fill="#F472B6" fill-opacity=".7"/>
            <g class="v-pop" style="animation-delay:.7s">
                <rect x="156" y="82" width="76" height="30" rx="9" fill="#ECFDF5" stroke="#BBF7D0"/>
                <circle cx="170" cy="97" r="8" fill="#10B981"/>
                <path d="M166 97l2.7 2.7 4.8-5.5" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                <text x="184" y="100" fill="#047857" font-size="8" font-weight="800">APPROVED</text>
            </g>
        @break

        @case('payment')
            <rect x="28" y="28" width="104" height="66" rx="12" fill="#F3EFFF" stroke="#D9CBF8"/>
            <rect x="36" y="38" width="36" height="6" rx="3" fill="#A78BFA"/>
            <rect x="36" y="52" width="72" height="16" rx="5" fill="#fff" fill-opacity=".72"/>
            <rect x="42" y="58" width="28" height="4" rx="2" fill="#C9B8F5"/>
            <circle cx="102" cy="78" r="7" fill="#F472B6" fill-opacity=".7"/>
            <circle cx="112" cy="78" r="7" fill="#60A5FA" fill-opacity=".6"/>
            <g class="v-pop" style="animation-delay:.35s">
                <circle cx="164" cy="48" r="16" fill="#10B981"/>
                <path d="M156.5 48l5 5 9-10" stroke="#fff" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <rect x="188" y="28" width="44" height="66" rx="8" fill="#fff" stroke="#E9E3F7"/>
            <rect x="194" y="36" width="32" height="9" rx="3" fill="#F3EFFF"/>
            <rect x="194" y="50" width="32" height="9" rx="3" fill="#F3EFFF"/>
            <rect x="194" y="64" width="32" height="9" rx="3" fill="#F3EFFF"/>
            <circle cx="224" cy="40" r="2" fill="#10B981" class="v-blink"/>
            <circle cx="224" cy="54" r="2" fill="#10B981" class="v-blink" style="animation-delay:.2s"/>
            <circle cx="224" cy="68" r="2" fill="#F59E0B" class="v-blink" style="animation-delay:.4s"/>
            <path d="M168 76h52" stroke="#E9E3F7" stroke-width="1.5" stroke-dasharray="3 4"/>
            <text x="168" y="90" fill="#047857" font-size="7.5" font-weight="800">VERIFIED</text>
        @break

        @case('track')
            <path d="M38 68h184" stroke="#E9E3F7" stroke-width="5" stroke-linecap="round"/>
            <path d="M38 68h122" stroke="#8B5CF6" stroke-width="5" stroke-linecap="round" class="v-draw"/>
            <circle cx="38" cy="68" r="11" fill="#8B5CF6"/>
            <path d="M34 68l3 3 5-6" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            <circle cx="100" cy="68" r="11" fill="#8B5CF6"/>
            <circle cx="100" cy="68" r="4" fill="#fff"/>
            <circle cx="160" cy="68" r="11" fill="#fff" stroke="#D9CBF8" stroke-width="2"/>
            <circle cx="160" cy="68" r="4" fill="#D9CBF8" class="v-pulse"/>
            <circle cx="222" cy="68" r="11" fill="#fff" stroke="#E9E3F7" stroke-width="2"/>
            <text x="27" y="94" fill="#7C5CE5" font-size="7" font-weight="800">SENT</text>
            <text x="84" y="94" fill="#7C5CE5" font-size="7" font-weight="800">APPROVED</text>
            <text x="145" y="94" fill="#9B96AE" font-size="7" font-weight="800">PAID</text>
            <text x="207" y="94" fill="#9B96AE" font-size="7" font-weight="800">MOVE IN</text>
            <rect x="74" y="30" width="112" height="18" rx="9" fill="#F3EFFF"/>
            <text x="91" y="42" fill="#6D4BD8" font-size="8" font-weight="800">BOOKING IN PROGRESS</text>
        @break

        @case('document')
            <rect x="72" y="20" width="100" height="96" rx="10" fill="#fff" stroke="#E9E3F7"/>
            <rect x="84" y="32" width="48" height="6" rx="3" fill="#D8D2E8"/>
            <rect x="84" y="46" width="76" height="4" rx="2" fill="#ECE8F7"/>
            <rect x="84" y="56" width="66" height="4" rx="2" fill="#ECE8F7"/>
            <rect x="84" y="66" width="72" height="4" rx="2" fill="#ECE8F7"/>
            <path d="M84 94c10-10 14 4 22-4 6-6 10 2 16-3" stroke="#8B5CF6" stroke-width="1.8" stroke-linecap="round" class="v-draw"/>
            <rect x="84" y="101" width="38" height="3" rx="1.5" fill="#D8D2E8"/>
            <g class="v-bounce">
                <circle cx="196" cy="56" r="17" fill="#F3EFFF" stroke="#E1D6FB"/>
                <path d="M196 47v14M190 56l6 6 6-6" stroke="#8B5CF6" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <g class="v-pop" style="animation-delay:.5s">
                <circle cx="198" cy="94" r="13" fill="#10B981"/>
                <path d="M192 94l4 4 8-9" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
        @break

        @case('review')
            <rect x="34" y="28" width="98" height="76" rx="12" fill="#fff" stroke="#E9E3F7"/>
            <g>
                <path d="M55 44l3.5 8 8.5.6-6.5 5.4 2 8.4-7.5-4.4-7.5 4.4 2-8.4-6.5-5.4 8.5-.6z" fill="#FDE68A"/>
                <path d="M77 44l3.5 8 8.5.6-6.5 5.4 2 8.4-7.5-4.4-7.5 4.4 2-8.4-6.5-5.4 8.5-.6z" fill="#FDE68A"/>
                <path d="M99 44l3.5 8 8.5.6-6.5 5.4 2 8.4-7.5-4.4-7.5 4.4 2-8.4-6.5-5.4 8.5-.6z" fill="#FDE68A"/>
                <path d="M121 44l3.5 8 8.5.6-6.5 5.4 2 8.4-7.5-4.4-7.5 4.4 2-8.4-6.5-5.4 8.5-.6z" fill="#FDE68A"/>
            </g>
            <g class="v-pop">
                <path d="M48 78l3.5 8 8.5.6-6.5 5.4 2 8.4-7.5-4.4-7.5 4.4 2-8.4-6.5-5.4 8.5-.6z" fill="#F472B6"/>
            </g>
            <rect x="148" y="34" width="80" height="42" rx="11" fill="#F3EFFF" stroke="#E1D6FB"/>
            <rect x="158" y="45" width="52" height="5" rx="2.5" fill="#C9B8F5"/>
            <rect x="158" y="56" width="36" height="5" rx="2.5" fill="#DCD5EE"/>
            <g class="v-bounce" style="animation-delay:.4s">
                <circle cx="196" cy="96" r="15" fill="#FDF2F8" stroke="#F7D6E6"/>
                <text x="191" y="101" fill="#F472B6" font-size="13" font-weight="800">4.9</text>
            </g>
        @break

        {{-- ---------------------------------------------------------------
             OWNER
        --------------------------------------------------------------- --}}
        @case('owner')
            <rect x="42" y="26" width="128" height="82" rx="13" fill="#fff" stroke="#E9E3F7"/>
            <circle cx="72" cy="60" r="18" fill="#EDE7FF"/>
            <circle cx="72" cy="54" r="6" fill="#8B5CF6"/>
            <path d="M60 72c2.5-8 21.5-8 24 0" fill="#8B5CF6" fill-opacity=".5"/>
            <rect x="100" y="44" width="56" height="7" rx="3.5" fill="#CDC5E3"/>
            <rect x="100" y="59" width="42" height="5" rx="2.5" fill="#ECE8F7"/>
            <rect x="100" y="72" width="48" height="15" rx="7.5" fill="#F3EFFF"/>
            <text x="108" y="83" fill="#7C5CE5" font-size="7" font-weight="800">OWNER</text>
            <g class="v-pop" style="animation-delay:.4s">
                <circle cx="190" cy="42" r="15" fill="#10B981"/>
                <path d="M183 42l4 4 8-9" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <g class="v-float">
                <circle cx="198" cy="94" r="16" fill="#F3EFFF" stroke="#E1D6FB"/>
                <path d="M190 94l5 5 9-10" stroke="#8B5CF6" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
        @break

        @case('listing')
            <rect x="42" y="34" width="88" height="75" rx="8" fill="#F3EFFF" stroke="#D9CBF8"/>
            <rect x="56" y="52" width="18" height="18" rx="3" fill="#fff" fill-opacity=".75"/>
            <rect x="84" y="52" width="18" height="18" rx="3" fill="#fff" fill-opacity=".75"/>
            <rect x="56" y="80" width="18" height="18" rx="3" fill="#fff" fill-opacity=".75"/>
            <rect x="84" y="80" width="18" height="18" rx="3" fill="#fff" fill-opacity=".75"/>
            <path d="M32 34l54-22 54 22" stroke="#A78BFA" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            <g class="v-pop" style="animation-delay:.3s">
                <circle cx="176" cy="62" r="24" fill="#8B5CF6"/>
                <path d="M176 52v20M166 62h20" stroke="#fff" stroke-width="3" stroke-linecap="round"/>
            </g>
            <rect x="152" y="94" width="60" height="6" rx="3" fill="#D8D2E8"/>
            <rect x="162" y="105" width="40" height="5" rx="2.5" fill="#ECE8F7"/>
        @break

        @case('photos')
            <rect x="44" y="40" width="84" height="58" rx="9" fill="#fff" stroke="#E9E3F7" transform="rotate(-5 86 69)"/>
            <rect x="56" y="32" width="84" height="58" rx="9" fill="#fff" stroke="#E9E3F7" transform="rotate(3 98 61)"/>
            <rect x="66" y="26" width="84" height="58" rx="9" fill="#EAF2FF" stroke="#CFE2FF"/>
            <path d="M78 68l17-20 12 13 10-8 20 15v5H78z" fill="#93C5FD"/>
            <circle cx="134" cy="42" r="5" fill="#FDE68A"/>
            <g class="v-bounce">
                <circle cx="190" cy="56" r="20" fill="#F3EFFF" stroke="#E1D6FB"/>
                <path d="M190 45v18M182 55l8-8 8 8" stroke="#8B5CF6" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <rect x="170" y="86" width="40" height="6" rx="3" fill="#D8D2E8"/>
            <rect x="178" y="97" width="24" height="5" rx="2.5" fill="#ECE8F7"/>
        @break

        @case('price')
            <path d="M46 40h58l40 26-40 26H46a10 10 0 01-10-10V50a10 10 0 0110-10z" fill="#F3EFFF" stroke="#D9CBF8"/>
            <circle cx="52" cy="53" r="5" fill="#fff"/>
            <text x="66" y="74" fill="#6D4BD8" font-size="26" font-weight="800">₹</text>
            <rect x="148" y="38" width="74" height="9" rx="4.5" fill="#E4DDF5"/>
            <circle cx="186" cy="42.5" r="9" fill="#8B5CF6" class="v-slide"/>
            <rect x="148" y="62" width="74" height="6" rx="3" fill="#ECE8F7"/>
            <rect x="148" y="77" width="58" height="6" rx="3" fill="#ECE8F7"/>
            <rect x="148" y="92" width="46" height="16" rx="8" fill="#FDF2F8" stroke="#F7D6E6"/>
            <text x="156" y="103" fill="#BE3D80" font-size="7" font-weight="800">/ MONTH</text>
        @break

        @case('amenities')
            <g class="v-pulse">
                <rect x="42" y="34" width="36" height="28" rx="8" fill="#F3EFFF" stroke="#D9CBF8"/>
                <path d="M52 50h16M60 42v16" stroke="#8B5CF6" stroke-width="2" stroke-linecap="round"/>
            </g>
            <g class="v-pulse" style="animation-delay:.2s">
                <rect x="86" y="34" width="36" height="28" rx="8" fill="#FDF2F8" stroke="#F7D6E6"/>
                <path d="M96 48h14v-4a5 5 0 00-5-5h-4a5 5 0 00-5 5v4zm2 0v5m10-5v5" stroke="#F472B6" stroke-width="1.8" stroke-linecap="round"/>
            </g>
            <g class="v-pulse" style="animation-delay:.4s">
                <rect x="130" y="34" width="36" height="28" rx="8" fill="#EAF2FF" stroke="#CFE2FF"/>
                <path d="M140 50c4-8 12-8 16 0M148 44v10" stroke="#60A5FA" stroke-width="1.8" stroke-linecap="round"/>
            </g>
            <rect x="42" y="72" width="36" height="28" rx="8" fill="#F3EFFF" stroke="#D9CBF8"/>
            <path d="M54 86h12M60 80v12" stroke="#8B5CF6" stroke-width="1.8" stroke-linecap="round"/>
            <rect x="86" y="72" width="36" height="28" rx="8" fill="#F3EFFF" stroke="#D9CBF8"/>
            <circle cx="104" cy="86" r="6" stroke="#8B5CF6" stroke-width="1.8"/>
            <rect x="130" y="72" width="36" height="28" rx="8" fill="#F3EFFF" stroke="#D9CBF8"/>
            <path d="M142 90c3-8 10-10 16-6" stroke="#8B5CF6" stroke-width="1.8" stroke-linecap="round"/>
            <g class="v-pop" style="animation-delay:.6s">
                <rect x="182" y="44" width="40" height="48" rx="8" fill="#ECFDF5" stroke="#BBF7D0"/>
                <path d="M194 68l6 6 11-13" stroke="#10B981" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
        @break

        @case('submit')
            <path d="M64 32l-14 44 46-12 62 20 22-62-116 10z" fill="#F3EFFF" stroke="#D9CBF8"/>
            <path d="M50 76l48-22M96 54l20 30" stroke="#A78BFA" stroke-width="1.6" stroke-linecap="round"/>
            <path d="M108 84l52-54" stroke="#8B5CF6" stroke-width="2" stroke-linecap="round" stroke-dasharray="5 5" class="v-draw"/>
            <g class="v-pop" style="animation-delay:.4s">
                <path d="M194 26l22-8 18 8v22c0 15-10 26-20 30-10-4-20-15-20-30V26z" fill="#F1ECFF" stroke="#C9B8F5" stroke-width="1.5"/>
                <path d="M204 44l6 6 12-13" stroke="#8B5CF6" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <rect x="50" y="92" width="70" height="6" rx="3" fill="#D8D2E8"/>
            <rect x="50" y="104" width="46" height="5" rx="2.5" fill="#ECE8F7"/>
        @break

        @case('inbox')
            <rect x="46" y="38" width="82" height="56" rx="8" fill="#F3EFFF" stroke="#D9CBF8"/>
            <path d="M46 44l41 28 41-28" stroke="#A78BFA" stroke-width="2" stroke-linejoin="round"/>
            <rect x="60" y="30" width="82" height="56" rx="8" fill="#fff" stroke="#E9E3F7"/>
            <path d="M60 36l41 28 41-28" stroke="#C9B8F5" stroke-width="2" stroke-linejoin="round"/>
            <g class="v-pop">
                <circle cx="140" cy="32" r="8" fill="#F472B6"/>
                <circle cx="140" cy="32" r="12" fill="#F472B6" fill-opacity=".18" class="v-pulse"/>
            </g>
            <rect x="156" y="66" width="66" height="40" rx="9" fill="#FDF2F8" stroke="#F7D6E6"/>
            <rect x="164" y="76" width="40" height="5" rx="2.5" fill="#F0A3CD"/>
            <rect x="164" y="87" width="28" height="4" rx="2" fill="#F8D7E5"/>
            <g class="v-blink">
                <circle cx="204" cy="80" r="2.5" fill="#F472B6"/>
                <circle cx="212" cy="80" r="2.5" fill="#F472B6" style="animation-delay:.2s"/>
            </g>
        @break

        @case('reply')
            <rect x="34" y="30" width="108" height="38" rx="12" fill="#F3EFFF" stroke="#E1D6FB"/>
            <rect x="46" y="41" width="62" height="5" rx="2.5" fill="#C9B8F5"/>
            <rect x="46" y="52" width="42" height="5" rx="2.5" fill="#DCD5EE"/>
            <g class="v-slide" style="animation-delay:.2s">
                <rect x="118" y="76" width="108" height="36" rx="12" fill="#FDF2F8" stroke="#F7D6E6"/>
                <rect x="130" y="86" width="60" height="5" rx="2.5" fill="#F0A3CD"/>
                <rect x="130" y="97" width="38" height="5" rx="2.5" fill="#F8D7E5"/>
            </g>
            <g class="v-bounce" style="animation-delay:.4s">
                <circle cx="204" cy="45" r="19" fill="#8B5CF6"/>
                <path d="M196 45h16M206 39l6 6-6 6" stroke="#fff" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
        @break

        @case('approve')
            <rect x="28" y="28" width="94" height="76" rx="11" fill="#fff" stroke="#E9E3F7"/>
            <rect x="38" y="38" width="54" height="6" rx="3" fill="#D8D2E8"/>
            <rect x="38" y="52" width="74" height="5" rx="2.5" fill="#ECE8F7"/>
            <rect x="38" y="63" width="62" height="5" rx="2.5" fill="#ECE8F7"/>
            <rect x="38" y="78" width="34" height="16" rx="8" fill="#ECFDF5" stroke="#BBF7D0"/>
            <rect x="78" y="78" width="34" height="16" rx="8" fill="#FEF2F2" stroke="#FECACA"/>
            <g class="v-pop" style="animation-delay:.3s">
                <circle cx="164" cy="60" r="22" fill="#10B981"/>
                <path d="M154 60l7 7 13-15" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <rect x="194" y="34" width="34" height="34" rx="9" fill="#FEF2F2" stroke="#FECACA"/>
            <path d="M204 44l14 14M218 44l-14 14" stroke="#F87171" stroke-width="2" stroke-linecap="round"/>
            <text x="190" y="94" fill="#047857" font-size="8" font-weight="800">ACCEPTED</text>
        @break

        @case('earnings')
            <rect x="36" y="30" width="96" height="74" rx="11" fill="#fff" stroke="#E9E3F7"/>
            <rect x="48" y="80" width="12" height="14" rx="3" fill="#D9CBF8" class="v-grow"/>
            <rect x="66" y="68" width="12" height="26" rx="3" fill="#B9A7EA" class="v-grow" style="animation-delay:.1s"/>
            <rect x="84" y="56" width="12" height="38" rx="3" fill="#A78BFA" class="v-grow" style="animation-delay:.2s"/>
            <rect x="102" y="44" width="12" height="50" rx="3" fill="#8B5CF6" class="v-grow" style="animation-delay:.3s"/>
            <path d="M48 74l18-12 18-10 24-10" stroke="#F472B6" stroke-width="2" stroke-linecap="round" class="v-draw"/>
            <g class="v-pop" style="animation-delay:.4s">
                <circle cx="178" cy="58" r="22" fill="#FDF2F8" stroke="#F7D6E6"/>
                <text x="170" y="65" fill="#BE3D80" font-size="17" font-weight="800">₹</text>
            </g>
            <rect x="154" y="92" width="58" height="6" rx="3" fill="#D8D2E8"/>
            <rect x="164" y="103" width="38" height="5" rx="2.5" fill="#ECE8F7"/>
        @break

        @case('agreement')
            <rect x="66" y="22" width="92" height="94" rx="10" fill="#fff" stroke="#E9E3F7"/>
            <rect x="78" y="34" width="44" height="6" rx="3" fill="#D8D2E8"/>
            <rect x="78" y="48" width="68" height="4" rx="2" fill="#ECE8F7"/>
            <rect x="78" y="58" width="58" height="4" rx="2" fill="#ECE8F7"/>
            <rect x="78" y="68" width="64" height="4" rx="2" fill="#ECE8F7"/>
            <path d="M78 92c9-9 13 4 21-4 6-5 10 2 16-3" stroke="#8B5CF6" stroke-width="1.8" stroke-linecap="round" class="v-draw"/>
            <g class="v-pulse" style="animation-delay:.3s">
                <path d="M188 34l20-8 16 8v20c0 14-9 24-18 28-9-4-18-14-18-28V34z" fill="#F1ECFF" stroke="#C9B8F5" stroke-width="1.5"/>
                <path d="M197 50l5 5 10-11" stroke="#8B5CF6" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
        @break

        @case('rating')
            <g class="v-pop">
                <path d="M64 38l6 13 14 2-10 9 3 14-13-7-13 7 3-14-10-9 14-2z" fill="#FDE68A"/>
            </g>
            <g class="v-pop" style="animation-delay:.15s">
                <path d="M102 38l6 13 14 2-10 9 3 14-13-7-13 7 3-14-10-9 14-2z" fill="#FDE68A"/>
            </g>
            <g class="v-pop" style="animation-delay:.3s">
                <path d="M140 38l6 13 14 2-10 9 3 14-13-7-13 7 3-14-10-9 14-2z" fill="#FDE68A"/>
            </g>
            <text x="52" y="100" fill="#9B96AE" font-size="8" font-weight="700">Tenant feedback</text>
            <rect x="176" y="36" width="52" height="52" rx="12" fill="#F3EFFF" stroke="#D9CBF8"/>
            <path d="M192 62l6-18 6 18M194 56h8M208 62V46m0 0l-4 4m4-4l4 4" stroke="#8B5CF6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        @break

        {{-- ---------------------------------------------------------------
             ADMIN
        --------------------------------------------------------------- --}}
        @case('users')
            <circle cx="58" cy="54" r="15" fill="#EDE7FF"/>
            <circle cx="58" cy="49" r="5" fill="#8B5CF6"/>
            <path d="M49 64c2-6 16-6 18 0" fill="#8B5CF6" fill-opacity=".5"/>
            <circle cx="98" cy="46" r="14" fill="#FDF2F8"/>
            <circle cx="98" cy="41" r="5" fill="#F472B6"/>
            <path d="M90 55c2-5 14-5 16 0" fill="#F472B6" fill-opacity=".5"/>
            <circle cx="134" cy="58" r="14" fill="#EAF2FF"/>
            <circle cx="134" cy="53" r="5" fill="#60A5FA"/>
            <path d="M126 67c2-5 14-5 16 0" fill="#60A5FA" fill-opacity=".5"/>
            <rect x="44" y="78" width="24" height="15" rx="7.5" fill="#F3EFFF"/>
            <text x="50" y="88" fill="#7C5CE5" font-size="6" font-weight="800">ADMIN</text>
            <rect x="74" y="78" width="30" height="15" rx="7.5" fill="#FDF2F8"/>
            <text x="80" y="88" fill="#BE3D80" font-size="6" font-weight="800">OWNER</text>
            <rect x="110" y="78" width="34" height="15" rx="7.5" fill="#EAF2FF"/>
            <text x="116" y="88" fill="#2563EB" font-size="6" font-weight="800">TENANT</text>
            <g class="v-pop" style="animation-delay:.4s">
                <circle cx="198" cy="58" r="23" fill="#F3EFFF" stroke="#D9CBF8"/>
                <path d="M188 58l7 7 13-15" stroke="#8B5CF6" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <rect x="172" y="92" width="54" height="6" rx="3" fill="#D8D2E8"/>
        @break

        @case('kyc')
            <rect x="38" y="34" width="112" height="66" rx="10" fill="#fff" stroke="#E9E3F7"/>
            <circle cx="66" cy="56" r="13" fill="#EDE7FF"/>
            <circle cx="66" cy="51" r="4.5" fill="#8B5CF6"/>
            <path d="M58 64c2-5 14-5 16 0" fill="#8B5CF6" fill-opacity=".5"/>
            <rect x="86" y="46" width="50" height="5" rx="2.5" fill="#D8D2E8"/>
            <rect x="86" y="57" width="38" height="4" rx="2" fill="#ECE8F7"/>
            <rect x="48" y="78" width="72" height="5" rx="2.5" fill="#ECE8F7"/>
            <rect x="38" y="72" width="112" height="2" fill="#F472B6" class="v-scan"/>
            <g class="v-pop" style="animation-delay:.5s">
                <circle cx="186" cy="64" r="24" fill="#ECFDF5" stroke="#BBF7D0"/>
                <path d="M176 64l7 7 13-15" stroke="#10B981" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <rect x="160" y="96" width="52" height="6" rx="3" fill="#D8D2E8"/>
        @break

        @case('approvals')
            <rect x="40" y="46" width="92" height="58" rx="9" fill="#F7F4FE" stroke="#E9E3F7" transform="rotate(-4 86 75)"/>
            <rect x="48" y="36" width="92" height="58" rx="9" fill="#fff" stroke="#E9E3F7"/>
            <rect x="58" y="46" width="52" height="5" rx="2.5" fill="#D8D2E8"/>
            <rect x="58" y="58" width="70" height="4" rx="2" fill="#ECE8F7"/>
            <rect x="58" y="68" width="44" height="4" rx="2" fill="#ECE8F7"/>
            <rect x="58" y="80" width="34" height="8" rx="4" fill="#F3EFFF"/>
            <g class="v-pop" style="animation-delay:.3s">
                <circle cx="172" cy="48" r="16" fill="#10B981"/>
                <path d="M164 48l5 5 9-10" stroke="#fff" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <g class="v-float" style="animation-delay:.3s">
                <rect x="160" y="72" width="62" height="32" rx="8" fill="#F3EFFF" stroke="#D9CBF8"/>
                <rect x="168" y="80" width="30" height="5" rx="2.5" fill="#C9B8F5"/>
                <rect x="168" y="90" width="42" height="5" rx="2.5" fill="#DCD5EE"/>
            </g>
        @break

        @case('monitor')
            <rect x="34" y="28" width="192" height="76" rx="11" fill="#fff" stroke="#E9E3F7"/>
            <rect x="42" y="36" width="46" height="60" rx="7" fill="#F3EFFF"/>
            <rect x="50" y="48" width="30" height="5" rx="2.5" fill="#C9B8F5"/>
            <rect x="50" y="60" width="24" height="4" rx="2" fill="#DCD5EE"/>
            <rect x="50" y="70" width="28" height="4" rx="2" fill="#DCD5EE"/>
            <rect x="50" y="80" width="18" height="4" rx="2" fill="#DCD5EE"/>
            <rect x="96" y="36" width="60" height="26" rx="7" fill="#EAF2FF"/>
            <circle cx="112" cy="49" r="5" fill="#60A5FA" class="v-pulse"/>
            <rect x="122" y="44" width="26" height="4" rx="2" fill="#BFDBFE"/>
            <rect x="122" y="52" width="18" height="4" rx="2" fill="#DBEAFE"/>
            <rect x="162" y="36" width="56" height="26" rx="7" fill="#FDF2F8"/>
            <circle cx="178" cy="49" r="5" fill="#F472B6" class="v-pulse" style="animation-delay:.2s"/>
            <rect x="188" y="44" width="22" height="4" rx="2" fill="#F8D7E5"/>
            <rect x="96" y="70" width="122" height="26" rx="7" fill="#FBF7FF"/>
            <path d="M104 88c10-12 16 3 26-6 8-7 14 5 22-3 9-9 16 3 26-5 8-6 16 4 28-2" stroke="#8B5CF6" stroke-width="2" stroke-linecap="round" class="v-draw"/>
            <circle cx="214" cy="82" r="3" fill="#F472B6" class="v-pulse"/>
        @break

        @case('ledger')
            <rect x="34" y="28" width="192" height="76" rx="11" fill="#fff" stroke="#E9E3F7"/>
            <rect x="44" y="36" width="172" height="14" rx="5" fill="#F3EFFF"/>
            <rect x="52" y="41" width="34" height="4" rx="2" fill="#C9B8F5"/>
            <rect x="150" y="41" width="24" height="4" rx="2" fill="#C9B8F5"/>
            <rect x="188" y="41" width="18" height="4" rx="2" fill="#C9B8F5"/>
            <rect x="52" y="58" width="44" height="4" rx="2" fill="#ECE8F7"/>
            <rect x="150" y="58" width="22" height="4" rx="2" fill="#D8D2E8"/>
            <circle cx="197" cy="60" r="6" fill="#ECFDF5"/>
            <path d="M194.5 60l2 2 3.5-4" stroke="#10B981" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <rect x="52" y="70" width="34" height="4" rx="2" fill="#ECE8F7"/>
            <rect x="150" y="70" width="26" height="4" rx="2" fill="#D8D2E8"/>
            <circle cx="197" cy="72" r="6" fill="#ECFDF5"/>
            <path d="M194.5 72l2 2 3.5-4" stroke="#10B981" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <rect x="52" y="82" width="38" height="4" rx="2" fill="#ECE8F7"/>
            <rect x="150" y="82" width="20" height="4" rx="2" fill="#D8D2E8"/>
            <circle cx="197" cy="84" r="6" fill="#FEF3C7"/>
            <path d="M197 81v4M197 87v.5" stroke="#F59E0B" stroke-width="1.6" stroke-linecap="round"/>
        @break

        @case('refund')
            <path d="M88 42a30 30 0 11-21 9" stroke="#C9B8F5" stroke-width="4" stroke-linecap="round" fill="none"/>
            <path d="M88 30v14H74" stroke="#8B5CF6" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" fill="none" class="v-pop"/>
            <circle cx="88" cy="76" r="24" fill="#F3EFFF"/>
            <text x="79" y="84" fill="#6D4BD8" font-size="20" font-weight="800">₹</text>
            <g class="v-float">
                <rect x="160" y="40" width="62" height="30" rx="8" fill="#ECFDF5" stroke="#BBF7D0"/>
                <circle cx="176" cy="55" r="8" fill="#10B981"/>
                <path d="M172 55l2.7 2.7 4.8-5.5" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                <rect x="190" y="51" width="22" height="4" rx="2" fill="#A7F3D0"/>
            </g>
            <text x="158" y="94" fill="#047857" font-size="8" font-weight="800">REFUND SENT</text>
        @break

        @case('reports')
            <rect x="34" y="28" width="192" height="76" rx="11" fill="#fff" stroke="#E9E3F7"/>
            <rect x="46" y="38" width="60" height="6" rx="3" fill="#D8D2E8"/>
            <path d="M48 90l24-14 20 8 24-20 20 6 30-22" stroke="#8B5CF6" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" class="v-draw"/>
            <circle cx="72" cy="76" r="3.5" fill="#F472B6" class="v-pulse"/>
            <circle cx="116" cy="64" r="3.5" fill="#60A5FA" class="v-pulse" style="animation-delay:.2s"/>
            <circle cx="166" cy="48" r="3.5" fill="#8B5CF6" class="v-pulse" style="animation-delay:.4s"/>
            <rect x="44" y="92" width="172" height="1.5" fill="#ECE8F7"/>
            <g class="v-float">
                <rect x="170" y="34" width="44" height="18" rx="9" fill="#F3EFFF"/>
                <text x="178" y="46" fill="#6D4BD8" font-size="8" font-weight="800">+24.8%</text>
            </g>
        @break

        @case('settings')
            <g class="v-spin" style="animation-duration:9s">
                <path d="M74 42l4-10 8 1 5 9a20 20 0 016 3l10-2 4 8-7 7v6l7 7-4 8-10-2a20 20 0 01-6 3l-5 9-8 1-4-10a20 20 0 01-5-3l-10 2-4-8 7-7v-6l-7-7 4-8 10 2a20 20 0 015-3z" fill="#F3EFFF" stroke="#D9CBF8" stroke-width="1.4"/>
                <circle cx="84" cy="66" r="11" fill="#fff" stroke="#A78BFA" stroke-width="2"/>
            </g>
            <rect x="142" y="38" width="76" height="24" rx="8" fill="#F3EFFF" stroke="#D9CBF8"/>
            <circle cx="198" cy="50" r="8" fill="#8B5CF6" class="v-slide"/>
            <rect x="142" y="72" width="76" height="24" rx="8" fill="#FDF2F8" stroke="#F7D6E6"/>
            <circle cx="166" cy="84" r="8" fill="#F472B6" class="v-slide" style="animation-delay:.4s"/>
            <rect x="150" y="46" width="22" height="5" rx="2.5" fill="#C9B8F5"/>
            <rect x="174" y="80" width="32" height="5" rx="2.5" fill="#F8D7E5"/>
        @break

        @case('shield')
            <circle cx="130" cy="66" r="46" fill="none" stroke="#F0EBFA" stroke-width="1.5" stroke-dasharray="4 6"/>
            <circle cx="130" cy="66" r="34" fill="none" stroke="#E5DCFB" stroke-width="1.5" stroke-dasharray="3 5"/>
            <path d="M130 24l30 12v26c0 20-14 34-30 40-16-6-30-20-30-40V36l30-12z" fill="#F1ECFF" stroke="#C9B8F5" stroke-width="1.5"/>
            <rect x="119" y="56" width="22" height="18" rx="5" fill="#8B5CF6"/>
            <path d="M124 56v-5a6 6 0 0112 0v5" stroke="#8B5CF6" stroke-width="2.4" stroke-linecap="round"/>
            <circle cx="130" cy="64" r="2.6" fill="#fff"/>
            <circle cx="130" cy="66" r="46" fill="none" stroke="#A78BFA" stroke-width="1.5" stroke-dasharray="10 90" class="v-spin" style="animation-duration:4s"/>
        @break

        @case('maintenance')
            <g class="v-float">
                <path d="M64 38a18 18 0 00-6 27l-8 8a6 6 0 108 8l8-8a18 18 0 0027-6l-13-4-6 6-8-8 6-6-8-17z" fill="#F3EFFF" stroke="#C9B8F5" stroke-width="1.5" stroke-linejoin="round"/>
                <circle cx="54" cy="68" r="3" fill="#8B5CF6"/>
            </g>
            <rect x="122" y="38" width="96" height="24" rx="8" fill="#F3EFFF" stroke="#D9CBF8"/>
            <circle cx="188" cy="50" r="8" fill="#8B5CF6" class="v-slide"/>
            <rect x="122" y="72" width="96" height="24" rx="8" fill="#ECFDF5" stroke="#BBF7D0"/>
            <circle cx="150" cy="84" r="8" fill="#10B981" class="v-slide" style="animation-delay:.4s"/>
            <rect x="132" y="46" width="34" height="5" rx="2.5" fill="#C9B8F5"/>
            <rect x="158" y="80" width="46" height="5" rx="2.5" fill="#A7F3D0"/>
            <text x="128" y="111" fill="#6D4BD8" font-size="7.5" font-weight="800">PLATFORM HEALTH</text>
        @break
    @endswitch
</svg>
