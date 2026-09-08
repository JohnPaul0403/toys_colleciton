<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { dashboard, login } from '@/routes'
</script>

<template>
    <div class="min-h-screen bg-background text-foreground">
        <!-- Navbar -->
        <header class="border-b border-[#49483e]">
            <nav
                class="mx-auto flex w-full max-w-6xl items-center justify-between px-6 py-4"
            >
                <Link href="/" class="text-xl font-bold text-[#e6db74]">
                    Toy Collection
                </Link>

                <div class="flex items-center gap-6">
                    <Link
                        href="/"
                        class="text-sm transition-opacity hover:opacity-70"
                    >
                        Toys
                    </Link>

                    <Link
                        href="/contact"
                        class="text-sm transition-opacity hover:opacity-70"
                    >
                        Contact
                    </Link>

                    <Link
                        v-if="$page.props.auth.user"
                        :href="dashboard()"
                        class="text-sm text-[#66d9ef]"
                    >
                        Dashboard
                    </Link>

                    <Link
                        v-else
                        :href="login()"
                        class="text-sm text-[#66d9ef]"
                    >
                        Log in
                    </Link>
                </div>
            </nav>
        </header>

        <!-- Page content -->
        <main class="mx-auto w-full max-w-6xl px-6 py-8">
            <slot />
        </main>

        <!-- Footer -->
        <footer class="border-t border-[#49483e]">
            <div
                class="mx-auto flex w-full max-w-6xl items-center justify-between px-6 py-6 text-sm text-muted-foreground"
            >
                <p>
                    © {{ new Date().getFullYear() }} Toy Collection
                </p>

                <p>
                    A personal collection archive
                </p>
            </div>
        </footer>
    </div>
</template>
