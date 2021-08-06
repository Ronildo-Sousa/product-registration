<template>
  <nav class="w-screen bg-gray-800">
  <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    <div class="relative flex items-center justify-between h-16">
      <div class="absolute inset-y-0 -left-1 flex items-center sm:hidden">
        <!-- Mobile menu button-->
        <img class="block lg:hidden h-8 w-5/12" src="../../assets/logo.svg" alt="logo">
        
      </div>
      <div class="flex-1 flex items-center justify-center -mr-4 sm:items-stretch sm:justify-start">
        <form action="#" method="get">
          <input type="search" name="search" class="text-sm rounded">
          <button type="submit">
          <i class="fas fa-search text-white ml-1"></i>
        </button>
        </form>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        <!-- Profile dropdown -->
        <div class="ml-3 relative">
          <div>
            <button type="button" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
              <span class="sr-only">Open user menu</span>
              <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>
</template>

<script>
export default {
    name: 'Navbar',
    data() {
      return {
        
      }
    },
    methods: {

    },
}
</script>

