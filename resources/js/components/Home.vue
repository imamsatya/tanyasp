<template>
<v-app>
    <div>
       
      
         

    <s-data :questions="this.questions"></s-data>

    </div>
</v-app>
</template>
<script>
    export default {
        props: [ 'questions', 'user'],
       
    }

</script>

