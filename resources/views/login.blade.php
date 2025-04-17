<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    @keyframes float {
      0% { transform: translateY(0); }
      50% { transform: translateY(-5px); }
      100% { transform: translateY(0); }
    }
    .float {
      animation: float 3s ease-in-out infinite;
    }
  </style>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            poppins: ['Poppins', 'sans-serif'],
          },
          colors: {
            lightBlue: {
              50: '#f0f9ff',
              100: '#e0f2fe',
              200: '#bae6fd',
              300: '#7dd3fc',
              400: '#38bdf8',
              500: '#0ea5e9',
              600: '#0284c7',
              700: '#0369a1',
              800: '#075985',
              900: '#0c4a6e',
            },
            darkBlue: {
              900: '#1e3a8a',
              800: '#1e40af',
              700: '#1d4ed8',
            }
          }
        }
      }
    }

    function app() {
      return {
        showPassword: false,
        togglePassword() {
          this.showPassword = !this.showPassword;
        }
      }
    }

    document.addEventListener('DOMContentLoaded', function () {
      feather.replace();
    });
  </script>
</head>
<body class="bg-gradient-to-br from-lightBlue-50 via-lightBlue-200 to-darkBlue-900 min-h-screen flex justify-center items-center p-4 font-poppins relative overflow-hidden">
  <!-- Elemen dekoratif gelembung -->
  <div class="absolute inset-0 overflow-hidden pointer-events-none">
    <div class="w-32 h-32 bg-lightBlue-200 rounded-full opacity-30 absolute -top-10 -left-10"></div>
    <div class="w-24 h-24 bg-lightBlue-300 rounded-full opacity-20 absolute top-20 right-10"></div>
    <div class="w-40 h-40 bg-lightBlue-100 rounded-full opacity-25 absolute bottom-0 left-20"></div>
  </div>

  <!-- Card login -->
  <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg border border-lightBlue-200 relative z-10" x-data="app()">
    <div class="text-center mb-8">
      <div class="mx-auto w-16 h-16 bg-lightBlue-100 rounded-full flex items-center justify-center mb-4 float">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-lightBlue-600">
          <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
          <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
        </svg>
      </div>
      <h2 class="text-3xl font-semibold text-darkBlue-800 mb-1">Login</h2>
      <p class="text-lightBlue-600 text-sm">Masuk ke akun Anda</p>
    </div>

    <!-- Form Login -->
    <form action="{{ route('login') }}" method="POST">
      @csrf
      <!-- Input Email -->
      <div class="mb-6">
        <label for="email" class="block text-darkBlue-900 text-sm font-medium mb-2">Email</label>
        <input type="email" id="email" name="email" required value="{{ old('email') }}"
          class="w-full px-4 py-3 bg-lightBlue-50 border border-lightBlue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-lightBlue-400 focus:border-lightBlue-400 transition duration-300"
          placeholder="Email kamu">
        @error('email')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
      </div>

      <!-- Input Password -->
      <div class="mb-6 relative">
        <label for="password" class="block text-darkBlue-900 text-sm font-medium mb-2">Password</label>
        <div class="relative">
          <input 
            :type="showPassword ? 'text' : 'password'" 
            id="password" 
            name="password" 
            required
            class="w-full px-4 py-3 pr-10 bg-lightBlue-50 border border-lightBlue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-lightBlue-400 focus:border-lightBlue-400 transition duration-300" 
            placeholder="Password kamu">
          <button 
            type="button" 
            @click="togglePassword" 
            class="absolute inset-y-0 right-0 pr-3 flex items-center text-lightBlue-400 hover:text-lightBlue-600"
            aria-label="Toggle password visibility">
            <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
              <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
            </svg>
            <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" style="display: none;">
              <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
              <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
            </svg>
          </button>
        </div>
        @error('password')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
      </div>

      <!-- Button Login -->
      <div class="mb-6">
        <button type="submit" class="w-full py-3 bg-darkBlue-700 text-white text-lg font-medium rounded-lg hover:bg-darkBlue-800 focus:outline-none focus:ring-2 focus:ring-lightBlue-500 transform hover:scale-105 transition-all duration-300 shadow-md">
          Masuk
        </button>
      </div>
    </form>
  </div>
</body>
</html>