<template>
    <v-card title="Agenda" flat>
        <template v-slot:text>
            <v-btn>Novo Agendamento</v-btn>
            <v-text-field v-model="search" label="Buscar" prepend-inner-icon="mdi-magnify" variant="outlined"
                hide-details single-line></v-text-field>
        </template>

        <v-data-table :headers="headers" :items="appointments" :search="search">
            <template v-slot:[`item.options`]="{ item }">
                <v-btn color="primary" @click="editAppointment(item)"><v-icon
                        icon="mdi mdi-square-edit-outline"></v-icon></v-btn>
                <v-btn color="error" @click="deleteAppointment(item.id)"><v-icon
                        icon="mdi mdi-delete-forever-outline"></v-icon></v-btn>
            </template>
        </v-data-table>
    </v-card>
    <v-btn color="primary" @click="dialogPetForm = true">Teste</v-btn>
    <v-dialog v-model="editDialog" max-width="500px">
        <v-card>
            <v-card-title>Editar Agendamento</v-card-title>

            <v-card>
                <v-card-title>Data e Hora</v-card-title>
                <v-card-text>
                    <v-date-input v-model="selectedDate" label="Data"
                        @update:model-value="onDateChange"
                        prepend-icon=""
                        type="datetime"
                        ></v-date-input>
                    <v-text-field v-model="editedAppointment.hour" label="Hora" type="time"></v-text-field>
                </v-card-text>
            </v-card>
            <v-card>
                <v-card-title>Pet</v-card-title>
                <v-card-text>
                    <v-text-field v-model="editedAppointment.pet_name" label="Nome" type="text"></v-text-field>
                    <v-text-field v-model="editedAppointment.pet_animal_type" label="Tipo"></v-text-field>
                    <v-text-field v-model="editedAppointment.pet_age" label="Idade" type="number"></v-text-field>
                </v-card-text>
            </v-card>
            <v-card>
                <v-card-title>Tutor</v-card-title>
                <v-card-text>
                    <v-text-field v-model="editedAppointment.tutor_name" label="Nome" type="text"></v-text-field>
                    <v-text-field v-model="editedAppointment.tutor_email" label="Email" type="email"></v-text-field>
                </v-card-text>
            </v-card>
            <v-card>
                <v-card-title>Veterinário</v-card-title>
                <v-card-text>
                    <v-text-field v-model="editedAppointment.tutor_name" label="Nome" type="text"></v-text-field>
                    <v-text-field v-model="editedAppointment.tutor_email" label="Email" type="email"></v-text-field>
                </v-card-text>
            </v-card>

            <v-card-actions>
                <v-btn color="primary" @click="saveAppointment">Salvar</v-btn>
                <v-btn text @click="editDialog = false">Cancelar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
    <v-dialog v-model="datePickerDialog" persistent width="290px">
        <v-date-picker
            v-model="editedAppointment.scheduled"
            @update:model-value="onDateChange"
        ></v-date-picker>
    </v-dialog>
    <DialogPetForm v-model="dialogPetForm" />
</template>

<script>
import axios from 'axios';
import DialogPetForm from './DialogPetForm.vue';

export default {
    name: "Calendar",
    components: {
        DialogPetForm,
    },
    data: () => ({
        appointments: [],
        currentPage: 1,
        datePickerDialog: false,
        dialogPetForm: false,
        editDialog: false,
        editedAppointment: {},
        search: '',
        selectedDate: null,
        headers: [
            {
                align: 'start',
                key: 'date',
                sortable: true,
                title: 'Data',
            },
            { key: 'hour', title: 'Hora' },
            { key: 'pet', title: 'Pet' },
            { key: 'animal_type', title: 'Tipo' },
            { key: 'doctor', title: 'Veterinário' },
            { key: 'options', title: 'Opções', sortable: false },
        ],
    }),
    mounted() {
        this.fetchAppointments();
    },
    methods: {
        async fetchAppointments() {
            try {
                const response = await axios.get('/api/appointments');
                console.log(response);
                this.appointments = this.formatAppointments(response.data);
            } catch (error) {
                console.error("Erro ao buscar appointments: ", error);
            }
        },
        formatAppointments(rawData) {
            console.log(rawData);
            return rawData.map((appointment) => ({
                id: appointment.id,
                scheduled: appointment.scheduled,
                date: appointment.scheduled.split(' ')[0],
                hour: appointment.scheduled.split(' ')[1],
                pet: appointment.pet.name,
                animal_type: appointment.pet.animal_type,
                doctor: appointment.doctor.name,
            }));
        },
        async deleteAppointment(id) {
            if (confirm('Tem certeza que deseja excluir este agendamento?')) {
                try {
                    await axios.delete(`/api/appointments/${id}`);
                    this.fetchAppointments();
                    alert('Agendamento deletado com sucesso!');
                } catch (error) {
                    console.error("Erro ao deletar appointments: ", error);
                }
            }
        },
        editAppointment(item) {
            console.log(item);
            this.editedAppointment = {};
            this.editDialog = true;
        },
        onDateChange(newDate) {
            const date = newDate.toJSON().split('T')[0];
            this.editedAppointment.scheduled = date;
            this.datePickerDialog = false;
        },
    }
};
</script>