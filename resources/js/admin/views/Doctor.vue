<template>
    <v-app>
        <div class="container">
            <h1>Doctor</h1>
            <v-data-table
                :headers="headers"
                :items="desserts"
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
                            <!--                            <template v-slot:activator="{ on }">-->
                            <!--                                <v-btn color="primary" dark class="mb-2" v-on="on">New doctor</v-btn>-->
                            <!--                            </template>-->
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
                                                        <v-file-input id="image" label="Profile image"></v-file-input>
                                                        <v-text-field v-validate="'required'"
                                                                      :error-messages="errors.collect('name')"
                                                                      data-vv-name="name"
                                                                      v-model="editedItem.name"
                                                                      label="Name"
                                                        ></v-text-field>
                                                        <v-text-field v-validate="'required'"
                                                                      :error-messages="errors.collect('surname')"
                                                                      data-vv-name="surname"
                                                                      v-model="editedItem.surname"
                                                                      label="Surname"
                                                        ></v-text-field>
                                                        <v-text-field v-validate="'required'"
                                                                      :error-messages="errors.collect('father_name')"
                                                                      data-vv-name="father_name"
                                                                      v-model="editedItem.father_name"
                                                                      label="Father Name"
                                                        ></v-text-field>
                                                        <v-text-field v-validate="'required'"
                                                                      :error-messages="errors.collect('birthday')"
                                                                      data-vv-name="birthday"
                                                                      v-model="editedItem.birthday"
                                                                      type="date"
                                                                      label="Birthday"
                                                        ></v-text-field>
                                                        <v-text-field v-validate="'required'"
                                                                      :error-messages="errors.collect('profession')"
                                                                      data-vv-name="profession"
                                                                      v-model="editedItem.profession"
                                                                      label="Profession"
                                                        ></v-text-field>
                                                        <v-text-field v-validate="'required'"
                                                                      :error-messages="errors.collect('phone')"
                                                                      data-vv-name="phone"
                                                                      v-model="editedItem.phone"
                                                                      label="Phone"
                                                        ></v-text-field>
                                                        <v-text-field v-validate="'required'"
                                                                      :error-messages="errors.collect('email')"
                                                                      data-vv-name="email"
                                                                      v-model="editedItem.email"
                                                                      type="email"
                                                                      label="Email"
                                                        ></v-text-field>
                                                        <v-text-field v-validate="'required'"
                                                                      :error-messages="errors.collect('short_about')"
                                                                      data-vv-name="short_about"
                                                                      v-model="editedItem.short_about"
                                                                      label="Short about"
                                                        ></v-text-field>
                                                        <ckeditor v-model="editedItem.about"
                                                                  v-validate="'required'"
                                                                  :error-messages="errors.collect('about')"
                                                                  data-vv-name="about"
                                                                  label="About"></ckeditor>
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
<!--                <template v-slot:item.image="{ item }">-->
<!--                    <img :src="item.profile_image" style="width: 50px; height: 50px" />-->
<!--                </template>-->
                <template v-slot:item.action="{ item }">
                    <v-icon
                        small
                        class="mr-2"
                        @click="editItem(item)"
                    >
                        edit
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
            // {text: 'Image', value: 'image'},
            {text: 'Name', value: 'name'},
            {text: 'Surname', value: 'surname'},
            {text: 'Father name', value: 'father_name'},
            {text: 'Birthday', value: 'birthday'},
            {text: 'Profession', value: 'profession'},
            {text: 'Short about', value: 'short_about'},
            {text: 'Phone', value: 'phone'},
            {text: 'Email', value: 'email'},
            {text: 'Location', value: 'location'},
            {text: 'Actions', value: 'action', sortable: false},
        ],
        desserts: [],
        editedIndex: -1,
        editedItem: {
            id: 0,
            name: '',
            surname: '',
            father_name: '',
            birthday: '',
            profession: '',
            short_about: '',
            phone: '',
            email: '',
            location: '',
            about: '',
        },
        defaultItem: {
            id: 0,
            name: '',
            surname: '',
            father_name: '',
            birthday: '',
            profession: '',
            short_about: '',
            phone: '',
            email: '',
            location: '',
            about: '',
        },
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? 'New doctor' : 'Edit doctor'
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
            axios.get('/adminAPI/doctor' + '?page=' + this.pagination.current)
                .then(function (resp) {
                    _this.desserts = resp.data.data
                    _this.pagination.current = resp.data.current_page
                    _this.pagination.total = resp.data.last_page
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
            axios.get('/adminAPI/doctor' + '?page=' + this.pagination.current)
                .then(function (resp) {
                    _this.pagination.current = resp.data.current_page
                    _this.pagination.total = resp.data.last_page
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

                            formData.append('id', newItem.id)
                            formData.append('name', newItem.name)
                            formData.append('surname', newItem.surname)
                            formData.append('father_name', newItem.father_name)
                            formData.append('birthday', newItem.birthday)
                            formData.append('profession', newItem.profession)
                            formData.append('short_about', newItem.short_about)
                            formData.append('phone', newItem.phone)
                            formData.append('email', newItem.email)
                            formData.append('location', newItem.location)
                            formData.append('about', newItem.about)
                            formData.append('image', document.getElementById('image').files[0] ?? null)

                            axios.post('/adminAPI/doctor/update/' + newItem.id, formData)
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
                                    console.log(resp);
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Opps!',
                                        text: resp,
                                    })
                                })
                        } else {
                            this.error = true
                        }
                    } else {
                        this.error = true
                    }
                })
        },
    },
}
</script>
