<template>
    <main>
        <div class="container">

            <Transition class="animate__animated animate__fadeIn">
                <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
                    <h1 class="text-light mb-3">404</h1>
                    <h2 class="text-light mb-5">The page you are looking for doesn't exist.</h2>
                    <router-link to="/home" class="btn btn-dark text-light">Back to Home</router-link>
                </section>
            </Transition>

        </div>
    </main>
</template>

<script>

</script>

<style scoped>
main {
    background: url('@/assets/img/background.jpg') center no-repeat;
	margin: 0 calc(-100vw / 2 + 100% / 2) !important;
    min-height: 0 !important;
}
</style>