<template>
    <v-app>
        <div class="container">
            <h1>Blogs</h1>
            <v-data-table
                :headers="headers"
                :items="desserts"
                :categories="categories"
                :search="search"
                disable-sort
                disable-filtering
                class="elevation-1"
                loading-text="Loading... Please wait"
                :loading=isLoading
                :hide-default-footer="true"
                dark
            >
                <template v-slot:top>
                    <v-toolbar flat>
                        <!--<v-text-field
                            v-model="search"
                            label="Search"
                            single-line
                            hide-details
                        ></v-text-field>
                        <v-divider
                            class="mx-4"
                            inset
                            vertical
                        ></v-divider>-->
                        <div class="flex-grow-1"></div>

                        <v-dialog class="zIndexModal" v-model="dialog" max-width="800px">
                            <template v-slot:activator="{ on }">
                                <v-btn color="primary" dark class="mb-2" v-on="on">New blog</v-btn>
                            </template>
                            <v-card>
                                <v-card-title>
                                    <span class="headline">{{ formTitle }}</span>
                                </v-card-title>

                                <v-card-text>
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12" v-if="error">
                                                <v-alert type="error">
                                                    Please fill correctly all inputs !
                                                </v-alert>
                                            </v-col>
                                            <v-col cols="12" sm="6" md="6">
                                                <v-text-field disabled v-model="editedItem.id"
                                                              label="ID"></v-text-field>
                                            </v-col>
                                            <template>
                                                <v-card
                                                    flat
                                                    tile
                                                >
                                                    <v-card-text>
                                                        <v-text-field v-validate="'required'"
                                                                      :error-messages="errors.collect('title')"
                                                                      data-vv-name="title"
                                                                      v-model="editedItem.title"
                                                                      label="Title"
                                                        ></v-text-field>
                                                        <v-text-field v-validate="'required'"
                                                                      :error-messages="errors.collect('short_content')"
                                                                      data-vv-name="short_content"
                                                                      v-model="editedItem.short_content"
                                                                      label="Short content"
                                                        ></v-text-field>
                                                        <v-select
                                                            v-validate="'required'" :error-messages="errors.collect('category_id')"
                                                            :data-vv-name="category_id"
                                                            v-model="editedItem.category_id"
                                                            :items="categories"
                                                            item-text="name"
                                                            item-value="id"
                                                            label="Category"
                                                        ></v-select>
                                                        <v-file-input id="image" label="Image"></v-file-input>
                                                        <ckeditor v-model="editedItem.content"
                                                                  v-validate="'required'"
                                                                  :error-messages="errors.collect('content')"
                                                                  data-vv-name="content"
                                                                  label="Content">
                                                        </ckeditor>
                                                    </v-card-text>
                                                </v-card>
                                            </template>
                                        </v-row>
                                    </v-container>
                                </v-card-text>

                                <v-card-actions>
                                    <div class="flex-grow-1"></div>
                                    <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                                    <v-btn color="blue darken-1" text @click="save">
                                        Save
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-toolbar>
                </template>
                <template v-slot:item.comments_action="{ item }">
                    {{item.comments_count}}
                    <v-icon
                        small
                        class="mr-2"
                        @click="goToComments(item.id)"
                    >
                        mdi-comment
                    </v-icon>
                </template>
                <template v-slot:item.action="{ item }">
                    <v-icon
                        small
                        class="mr-2"
                        @click="editItem(item)"
                    >
                        edit
                    </v-icon>
                    <v-icon
                        small
                        @click="deleteItem(item)"
                    >
                        delete
                    </v-icon>
                </template>
                <template v-slot:no-data>
                    <v-btn color="primary" @click="initialize">Reset</v-btn>
                </template>
            </v-data-table>
            <template>
                <div class="text-center">
                    <v-pagination
                        v-model="pagination.current"
                        :length="pagination.total"
                        @input="onPageChange"
                        :circle="circle"
                        :next-icon="nextIcon"
                        :prev-icon="prevIcon"
                        :total-visible="totalVisible"
                    ></v-pagination>
                </div>
            </template>
        </div>
    </v-app>
</template>

<script>
import Swal from 'sweetalert2'

export default {
    $_veeValidate: {
        validator: 'new',
    },
    components: {},
    data: () => ({
        tab: null,
        pagination: {
            current: 1,
            total: 0,
        },
        circle: true,
        nextIcon: 'navigate_next',
        prevIcon: 'navigate_before',
        totalVisible: 5,
        error: false,
        isLoading: true,
        search: '',
        dialog: false,
        headers: [
            {
                text: 'ID',
                align: 'left',
                value: 'id',
            },
            {text: 'Title', value: 'title'},
            {text: 'Category', value: 'category.name'},
            {text: 'Read count', value: 'read_count'},
            {text: 'Comments', value: 'comments_action'},
            {text: 'Actions', value: 'action', sortable: false},
        ],
        desserts: [],
        categories: [],
        editedIndex: -1,
        editedItem: {
            id: 0,
            title: '',
            short_content: '',
            content: '',
            category_id: '',
        },
        defaultItem: {
            id: 0,
            title: '',
            short_content: '',
            content: '',
            category_id: '',
        },
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? 'New social blog' : 'Edit social blog'
        },
    },

    watch: {
        dialog(val) {
            val || this.close()
        },
    },

    created() {
        this.initialize()
    },

    methods: {
        initialize() {
            let _this = this
            _this.isLoading = true
            axios.get('/adminAPI/blogs' + '?page=' + this.pagination.current)
                .then(function (resp) {
                    _this.categories = resp.data.categories
                    _this.desserts = resp.data.blogs.data
                    _this.pagination.current = resp.data.blogs.current_page
                    _this.pagination.total = resp.data.blogs.last_page
                })
                .catch(function (resp) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                })
                .finally(() => {
                    _this.isLoading = false
                })
        },
        initializePage() {
            let _this = this
            axios.get('/adminAPI/blogs' + '?page=' + this.pagination.current)
                .then(function (resp) {
                    _this.pagination.current = resp.data.blogs.current_page
                    _this.pagination.total = resp.data.blogs.last_page
                })
                .catch(function (resp) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                })
        },
        onPageChange() {
            this.initialize()
        },

        editItem(item) {
            this.editedIndex = this.desserts.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        goToComments(id) {
            this.$router.push('/admin/blogs/comments/' + id)
        },

        close() {
            this.dialog = false
            this.error = false
            setTimeout(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            }, 300)
        },

        save() {
            this.$validator.validateAll()
                .then(responses => {
                    if (responses) {
                        if (this.editedIndex > -1) {
                            const _this = this

                            let newItem = _this.editedItem

                            let formData = new FormData()

                            formData.append('title', newItem.title)
                            formData.append('short_content', newItem.short_content)
                            formData.append('content', newItem.content)
                            formData.append('category_id', newItem.category_id)
                            formData.append('image', document.getElementById('image').files[0] ?? null)

                            axios.post('/adminAPI/blogs/update/' + newItem.id, formData)
                                .then(function (resp) {
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Success!',
                                        text: resp.data.message,
                                    })
                                    _this.initialize()
                                    _this.close()
                                })
                                .catch(function (resp) {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Opps!',
                                        text: resp,
                                    })
                                })
                        } else {
                            const _this = this

                            let newItem = _this.editedItem

                            let formData = new FormData()

                            formData.append('title', newItem.title)
                            formData.append('short_content', newItem.short_content)
                            formData.append('content', newItem.content)
                            formData.append('category_id', newItem.category_id)
                            formData.append('image', document.getElementById('image').files[0] ?? null)

                            axios.post('/adminAPI/blogs/add/', formData).then((resp) => {
                                Swal.fire({
                                    type: 'success',
                                    title: 'Success!',
                                    text: resp.data.message,
                                })
                                _this.initialize()
                                _this.close()
                            }).catch(function (resp) {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Opps!',
                                    text: resp,
                                })
                            })
                        }
                    } else {
                        this.error = true
                    }
                })
        },

        deleteItem(item) {
            const index = this.desserts.indexOf(item)
            let app = this
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.value) {
                    axios.delete('/adminAPI/blogs/delete/' + item.id).then(function (resp) {
                        let old = app.pagination.current
                        app.initializePage()
                        Swal.fire({
                            type: 'success',
                            title: 'Success!',
                            text: resp.data.message,
                        }).finally(() => {
                            if (old >= app.pagination.total) {
                                app.pagination.current = app.pagination.total
                            } else {
                                app.pagination.current = old
                            }
                            app.initialize()
                        })
                    }).catch(function (resp) {
                        Swal.fire({
                            type: 'error',
                            title: 'Opps!',
                            text: resp,
                        })
                    })

                }
            })
        },
    },
}
</script>
