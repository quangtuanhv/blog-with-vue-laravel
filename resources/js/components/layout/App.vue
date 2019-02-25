<template>
    <div class="wrap">
        <header-desktop/>
        <router-view/>
        <footer-desktop/>
    </div>
</template>
<script>
import HeaderDesktop from './common/HeaderDesktop.vue'
import FooterDesktop from './common/FooterDesktop.vue'
export default {
    components: {
        HeaderDesktop,
        FooterDesktop
    }
}
</script>

