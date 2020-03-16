<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body" id="iu">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<style lang="scss">
    #iu{
        color: #0ab1fc;
    }
</style>

<script>



    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
