<template>
    <Transition class="animate__animated animate__fadeIn">
        <main>
            <div class="container">

                <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
                    <h1 class="text-primary mb-3">404</h1>
                    <h2 class="text-secondary mb-5">The page you are looking for doesn't exist.</h2>
                    <router-link to="/home" class="btn btn-primary">Back to Home</router-link>
                </section>

            </div>
        </main>
    </Transition>
</template>

<script>

</script>

<style scoped>
main {
    min-height: 0 !important;
}
</style>