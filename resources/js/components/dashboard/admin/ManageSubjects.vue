<template>
    <div id="content" class="fade-in">
        <div class="panel fade" v-if="subject_view == ''">
            <div class="title">Options</div>
            <div class="contents">
                <label for="subject_view">Select option to view</label>
                <select
                    name="subject_view"
                    id="subject_view"
                    v-model="subject_view"
                    @change="viewToggle"
                    class="input-box"
                >
                    <option>Manage Subjects</option>
                    <option>Add New Subject</option>
                </select>
            </div>
        </div>

        <div class="panel fade" v-if="subject_view == 'Manage Subjects'">
            <div class="back_button" @click="subject_view = ''">
                <i class="far fa-arrow-alt-circle-left"></i> &nbsp Back
            </div>
            <div class="title">Manage Subjects</div>
            <div class="contents">
                <datatable
                    v-bind:subjects="subjects"
                    @eventEdit="showModalEdit"
                    @eventDelete="showModalDelete"
                />
            </div>
        </div>

        <div class="panel fade" v-if="subject_view == 'Add New Subject'">
            <div class="back_button" @click="subject_view = ''">
                <i class="far fa-arrow-alt-circle-left"></i> &nbsp Back
            </div>
            <div class="title">Add New Subject</div>
            <div class="contents">
                <form @submit.prevent="addSubject">
                    <label for="subject_name">Subject Name</label>
                    <input
                        type="name"
                        id="subject_name"
                        name="subject_name"
                        v-model="subject.subject_name"
                        class="input-box"
                    />
                    <label for="acs">Academic Credit System</label>
                    <input
                        type="number"
                        id="acs"
                        name="acs"
                        v-model="subject.acs"
                        class="input-box"
                    />
                    <button type="submit" class="button-submit">Add</button>
                </form>
            </div>
        </div>

        <modalEdit
            :showModal="showModalE"
            :data="subjectbe"
            :id="idyangdigunakan"
            @reload="reloadSubjects"
            @event="showModalE = $event"
        />
        <modalDelete
            :showModal="showModalD"
            :data="subjectbd"
            @reload="reloadSubjects"
            @event="showModalD = $event"
        />
    </div>
</template>

<script>
import DataTablejs from "./../../datatables/Subjects.vue";
import Edit from "./../../modals/Edit.vue";
import Delete from "./../../modals/Delete.vue";

export default {
    components: {
        datatable: DataTablejs,
        modalEdit: Edit,
        modalDelete: Delete,
    },
    data: function () {
        return {
            subject_view: "",
            subjects: [],
            dtHandle: null,
            subject: {
                subject_name: "",
                acs: "",
            },

            subjectbe: [],
            idyangdigunakan: "",
            subjectbd: [],
            showModalE: false,
            showModalD: false,
        };
    },
    methods: {
        viewToggle() {
            if (this.subject_view == "Manage Subjects") {
                axios
                    .get("http://localhost:8000/api/show/subjects")
                    .then((res) => {
                        this.subjects = res.data;
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }
        },
        addSubject() {
            axios
                .post("http://localhost:8000/api/subject/create", this.subject)
                .then(
                    (response) => (
                        this.$emit("created", {
                            type: "create",
                            table: "subject",
                            status: "success",
                        }),
                        this.clearSubjectValue()
                    )
                )
                .catch((error) => {
                    this.tesError = error.response.data.errors;
                    if (this.tesError != undefined)
                        this.$emit("failed", {
                            errorMessage: this.tesError,
                            status: "failed",
                        });
                })
                .finally(() => (this.loading = false));
        },
        showModalEdit(idSubject) {
            axios
                .get("http://localhost:8000/api/subject/" + idSubject.idSubject)
                .then((res) => {
                    this.subjectbe = res.data;
                    this.idyangdigunakan = idSubject.idSubject;
                })
                .catch((err) => {
                    console.log(err);
                });
            setTimeout(() => {
                this.showModalE = !this.showModalE;
            }, 350);
        },
        showModalDelete(idSubject) {
            axios
                .get("http://localhost:8000/api/subject/" + idSubject.idSubject)
                .then((res) => {
                    this.subjectbd = res.data;
                })
                .catch((err) => {
                    console.log(err);
                });
            setTimeout(() => {
                this.showModalD = !this.showModalD;
            }, 350);
        },
        reloadSubjects() {
            axios
                .get("http://localhost:8000/api/show/subjects")
                .then((res) => {
                    this.subjects = res.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        clearSubjectValue() {
            this.subject.subject_name = "";
            this.subject.acs = "";
        },
    },
};
</script>
