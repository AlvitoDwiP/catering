<x-guest-layout>
    <h1 class="font-heading text-3xl text-nk-text">Masuk Sistem</h1>
    <p class="mt-1 text-sm text-nk-muted">Akses panel admin atau dapur Nad's Kitchen sesuai role akun Anda.</p>

    <x-auth-session-status class="mt-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
        @csrf

        <div>
            <x-input-label for="email" value="Email" class="text-nk-text" />
            <x-text-input id="email" class="mt-1 block w-full rounded-xl border-nk-border bg-white/80 focus:border-nk-primary focus:ring-nk-primary" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="Password" class="text-nk-text" />
            <x-text-input id="password" class="mt-1 block w-full rounded-xl border-nk-border bg-white/80 focus:border-nk-primary focus:ring-nk-primary" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-nk-muted">
                <input id="remember_me" type="checkbox" class="rounded border-nk-border text-nk-primary focus:ring-nk-primary" name="remember">
                <span>Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-nk-muted underline hover:text-nk-text" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <button type="submit" class="inline-flex w-full items-center justify-center rounded-full bg-nk-primary px-4 py-2.5 text-sm font-medium text-nk-card transition hover:opacity-90">
            Masuk
        </button>
    </form>
</x-guest-layout>
