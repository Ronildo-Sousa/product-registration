<template>
  <div >
    página home
  </div>
</template>

<script>
import app from '../services/app'

export default {
  name: 'Home',
  components: {
    
  },
  mounted() {
    app.getHome().then((response) => {
      console.log(response)
    })
  },
}
</script>
