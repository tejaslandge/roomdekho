<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project Documentation - RoomDekho') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Documentation Header -->
                    <div class="mb-10 text-center">
                        <h1 class="text-4xl font-extrabold text-blue-600 mb-4">RoomDekho Project Documentation</h1>
                        <p class="text-lg text-gray-500">A comprehensive overview of the RoomDekho System Architecture, Roles, and Features.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <!-- Sidebar Navigation -->
                        <div class="col-span-1">
                            <div class="sticky top-6">
                                <h3 class="text-xl font-bold mb-4 border-b pb-2">Table of Contents</h3>
                                <ul class="space-y-3 text-sm text-gray-700">
                                    <li><a href="#overview" class="hover:text-blue-600 transition">1. System Overview</a></li>
                                    <li><a href="#roles" class="hover:text-blue-600 transition">2. User Roles</a></li>
                                    <li><a href="#database" class="hover:text-blue-600 transition">3. Database Schema & Models</a></li>
                                    <li><a href="#controllers" class="hover:text-blue-600 transition">4. Architecture & Controllers</a></li>
                                    <li><a href="#routes" class="hover:text-blue-600 transition">5. Routing Structure</a></li>
                                    <li><a href="#key-features" class="hover:text-blue-600 transition">6. Key Features</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Main Content -->
                        <div class="col-span-3 space-y-12">
                            
                            <!-- 1. System Overview -->
                            <section id="overview" class="scroll-mt-6">
                                <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center border-b pb-2">
                                    <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    1. System Overview
                                </h2>
                                <p class="text-gray-600 leading-relaxed">
                                    <strong>RoomDekho</strong> is a robust rental property management platform built using the Laravel framework. It facilitates seamless interactions between property owners, tenants looking for rooms, and system administrators. The system handles end-to-end rental cycles including property listing, room search, booking, payment processing, agreement generation, and feedback/maintenance management.
                                </p>
                            </section>

                            <!-- 2. User Roles -->
                            <section id="roles" class="scroll-mt-6">
                                <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center border-b pb-2">
                                    <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    2. User Roles
                                </h2>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                                    <div class="bg-gray-50 p-5 rounded-xl border border-gray-100 shadow-sm">
                                        <h3 class="font-bold text-lg text-red-600 mb-2">Admin</h3>
                                        <p class="text-sm text-gray-600">Full system control. Can manage all users, oversee all properties, handle verifications, moderate agreements, and view systemic reports and payments.</p>
                                    </div>
                                    <div class="bg-gray-50 p-5 rounded-xl border border-gray-100 shadow-sm">
                                        <h3 class="font-bold text-lg text-blue-600 mb-2">Owner</h3>
                                        <p class="text-sm text-gray-600">Property managers who can list properties, manage rooms, accept/reject bookings, communicate with tenants, and handle maintenance requests.</p>
                                    </div>
                                    <div class="bg-gray-50 p-5 rounded-xl border border-gray-100 shadow-sm">
                                        <h3 class="font-bold text-lg text-green-600 mb-2">Tenant</h3>
                                        <p class="text-sm text-gray-600">End-users who search for properties, make booking requests, pay rent, sign agreements, raise maintenance tickets, and favorite rooms.</p>
                                    </div>
                                </div>
                            </section>

                            <!-- 3. Database Schema & Models -->
                            <section id="database" class="scroll-mt-6">
                                <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center border-b pb-2">
                                    <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                                    3. Database Schema & Models
                                </h2>
                                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Model</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description & Relationships</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                            <tr>
                                                <td class="px-6 py-4 font-mono font-medium text-blue-600">User</td>
                                                <td class="px-6 py-4 text-gray-600">Core authentication entity. Has roles (admin, owner, tenant). Has One `UserVerification`. Has Many `Properties`, `Bookings`, `Messages`.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 font-mono font-medium text-blue-600">Property</td>
                                                <td class="px-6 py-4 text-gray-600">Represents a building or location. Belongs to Owner (`User`). Has Many `Rooms`, `PropertyImages`.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 font-mono font-medium text-blue-600">Room</td>
                                                <td class="px-6 py-4 text-gray-600">Individual unit within a property. Belongs to `Property`. Has Many `Bookings`, `RoomImages`, `Favourites`. Many-to-Many with `Amenities`.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 font-mono font-medium text-blue-600">Booking</td>
                                                <td class="px-6 py-4 text-gray-600">Tracks reservation of a room by a tenant. Belongs to `User` (tenant) and `Room`. Has One `Agreement`. Has Many `Payments`.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 font-mono font-medium text-blue-600">Payment</td>
                                                <td class="px-6 py-4 text-gray-600">Records financial transactions (rent, deposit). Belongs to `Booking` and `User`. Tracks amount, status, and transaction ID.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 font-mono font-medium text-blue-600">Agreement</td>
                                                <td class="px-6 py-4 text-gray-600">Digital lease document tied to a `Booking`. Contains terms, signatures, and status (active, terminated).</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 font-mono font-medium text-blue-600">Message & Conversation</td>
                                                <td class="px-6 py-4 text-gray-600">Facilitates inter-user communication (e.g., Tenant to Owner). A `Conversation` has many `Messages`.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 font-mono font-medium text-blue-600">MaintenanceRequest</td>
                                                <td class="px-6 py-4 text-gray-600">Tickets raised by tenants for a specific room. Tracked by owners (status: open, in-progress, resolved).</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 font-mono font-medium text-blue-600">UserVerification</td>
                                                <td class="px-6 py-4 text-gray-600">KYC/Document verification for users before allowing booking functionalities. Verified by admins.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </section>

                            <!-- 4. Architecture & Controllers -->
                            <section id="controllers" class="scroll-mt-6">
                                <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center border-b pb-2">
                                    <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                    4. Architecture & Controllers
                                </h2>
                                <p class="text-gray-600 mb-4">
                                    The application follows the standard <strong>MVC (Model-View-Controller)</strong> architecture. Controllers are neatly organized based on either resource type or user role to maintain separation of concerns.
                                </p>
                                <ul class="space-y-4">
                                    <li class="flex items-start">
                                        <div class="flex-shrink-0 mt-1"><span class="w-2 h-2 rounded-full bg-blue-500 inline-block"></span></div>
                                        <div class="ml-3">
                                            <h4 class="font-semibold text-gray-800">Role-Based Controllers</h4>
                                            <p class="text-sm text-gray-600"><code>AdminController</code>, <code>OwnerController</code>, <code>TenantController</code> handle dashboard rendering and logic specific to each user type's overview.</p>
                                        </div>
                                    </li>
                                    <li class="flex items-start">
                                        <div class="flex-shrink-0 mt-1"><span class="w-2 h-2 rounded-full bg-blue-500 inline-block"></span></div>
                                        <div class="ml-3">
                                            <h4 class="font-semibold text-gray-800">Resource Controllers</h4>
                                            <p class="text-sm text-gray-600"><code>PropertyController</code>, <code>RoomController</code>, <code>BookingController</code>, <code>PaymentController</code> implement CRUD operations tailored to the specific entities.</p>
                                        </div>
                                    </li>
                                    <li class="flex items-start">
                                        <div class="flex-shrink-0 mt-1"><span class="w-2 h-2 rounded-full bg-blue-500 inline-block"></span></div>
                                        <div class="ml-3">
                                            <h4 class="font-semibold text-gray-800">Feature Controllers</h4>
                                            <p class="text-sm text-gray-600"><code>MessageController</code>, <code>AgreementController</code>, <code>UserVerificationController</code> handle specialized business logic (chat, document generation, KYC validation).</p>
                                        </div>
                                    </li>
                                </ul>
                            </section>

                            <!-- 5. Routing Structure -->
                            <section id="routes" class="scroll-mt-6">
                                <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center border-b pb-2">
                                    <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                                    5. Routing Structure
                                </h2>
                                <p class="text-gray-600 mb-4">Routes are securely segregated using role-based middleware arrays in <code>routes/web.php</code>. All routes except the homepage require authentication and email verification.</p>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                        <h4 class="font-mono text-sm font-bold text-red-600 mb-2">/admin/*</h4>
                                        <p class="text-xs text-gray-500 mb-2">Middleware: <code>auth</code>, <code>role:admin</code></p>
                                        <ul class="text-sm font-mono text-gray-700 space-y-1">
                                            <li>/admin/dashboard</li>
                                            <li>/admin/users</li>
                                            <li>/admin/verifications</li>
                                            <li>/admin/properties</li>
                                        </ul>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                        <h4 class="font-mono text-sm font-bold text-blue-600 mb-2">/owner/*</h4>
                                        <p class="text-xs text-gray-500 mb-2">Middleware: <code>auth</code>, <code>role:owner</code></p>
                                        <ul class="text-sm font-mono text-gray-700 space-y-1">
                                            <li>/owner/dashboard</li>
                                            <li>/owner/properties</li>
                                            <li>/owner/rooms</li>
                                            <li>/owner/bookings</li>
                                        </ul>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                        <h4 class="font-mono text-sm font-bold text-green-600 mb-2">/tenant/*</h4>
                                        <p class="text-xs text-gray-500 mb-2">Middleware: <code>auth</code>, <code>role:tenant</code></p>
                                        <ul class="text-sm font-mono text-gray-700 space-y-1">
                                            <li>/tenant/dashboard</li>
                                            <li>/tenant/search</li>
                                            <li>/tenant/rent</li>
                                            <li>/tenant/payments</li>
                                        </ul>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                        <h4 class="font-mono text-sm font-bold text-purple-600 mb-2">/documentation</h4>
                                        <p class="text-xs text-gray-500 mb-2">Middleware: <code>auth</code></p>
                                        <p class="text-sm font-mono text-gray-700">Project technical analysis module.</p>
                                    </div>
                                </div>
                            </section>

                            <!-- 6. Key Features -->
                            <section id="key-features" class="scroll-mt-6">
                                <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center border-b pb-2">
                                    <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                                    6. Key Features Overview
                                </h2>
                                <div class="space-y-4">
                                    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                                        <h4 class="font-bold text-gray-800">Advanced Room Search & Filtering</h4>
                                        <p class="text-sm text-gray-600 mt-1">Tenants can search through listed rooms by location, amenities, and price. Integrated map functionalities enhance discoverability.</p>
                                    </div>
                                    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                                        <h4 class="font-bold text-gray-800">Secure Payment Integration</h4>
                                        <p class="text-sm text-gray-600 mt-1">Seamless rent and booking fee processing, securely tracked against Bookings.</p>
                                    </div>
                                    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                                        <h4 class="font-bold text-gray-800">Dynamic Lease Agreements</h4>
                                        <p class="text-sm text-gray-600 mt-1">Automatic generation of binding digital lease documents upon booking confirmation.</p>
                                    </div>
                                    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                                        <h4 class="font-bold text-gray-800">In-App Chat Engine</h4>
                                        <p class="text-sm text-gray-600 mt-1">Real-time messaging between Tenants and Owners for queries and negotiations prior to or during the rental period.</p>
                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
