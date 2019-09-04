<template>
    <form class="item-form" @submit.prevent="save" novalidate>
        <div>
            <input type="text" placeholder="Item name" v-model="item.name" required>
            $<input type="number" min="0" step=".01" v-model="item.price" required />
        </div>

        <div>
            <textarea v-model="item.description" placeholder="Item description" required></textarea>
        </div>

        <div>
            <select v-model="item.category_id" required>
                <option value="">Select a category</option>
                <option 
                    v-for="cat in categories"
                    :key="cat.id"
                    :value="cat.id">{{cat.name}}</option>
            </select>
        </div>

        <img v-if="id && item.image" :src="`/storage/images/${item.image}`" alt="" width="200">

        <drop-zone :options="dropzoneOptions" id="dz" ref="dropzone"></drop-zone>

        <button type="submit">Save</button>

        <ul>
            <li v-for="(error, index) in errors" :key="index">{{error}}</li>
        </ul>
    </form>
</template>

<script>
import vue2Dropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';
import { mapState } from 'vuex';

function newItem() {
    return {
        name: '',
        price: 0.00,
        image: '',
        category_id: '',
        description: '',
    };
}

export default {
    components: {
        dropZone: vue2Dropzone
    },
    props: ['id'], // id dc truyen qua param router link
    data() {
        return {
            dropzoneOptions: {
                url: '/api/add-image',
                thumbnailWidth: 200,
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                },
                success(file, res) {
                    // res la ten cua cai hinh (do laravel minh return ve)
                    file.filename = res // de tam vo filename de lat lay ra gan vo state
                }
            },
            item: newItem(),
            errors: []
        };
    },
    // computed: {
    //     categories() {
    //         return this.$store.state.categories
    //     },
    // },
    computed: mapState({
        categories: 'categories'
    }),
    created() {
        if (this.id) {
            axios
                .get(`/api/menu-items/${this.id}`)
                .then(res => this.item = res.data);
        }
    },
    beforeRouteLeave(to, from, next) {
        this.item = newItem()
        next()
    },
    methods: {
        save() {
            let files = this.$refs.dropzone.getAcceptedFiles();
            if (files.length > 0 && files[0].filename) {
                this.item.image = files[0].filename;
            }

            let url = '/api/menu-items/add'
            if (this.id) {
                url = '/api/menu-items/' + this.id // se la method post de edit
            }

            axios.post(url, this.item)
                .then(res => {
                    //console.log(res);
                    this.$router.push('/');
                }).catch(err => {
                    //console.log(err.response.data.errors);
                    // - Muc dich de sap xep lai data de dua va state 'errors'
                    let messages = Object.values(err.response.data.errors);
                    this.errors = [].concat.apply([], messages);
                    //console.log(this.errors);
                });
        }
    }
}
</script>