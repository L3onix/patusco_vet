<template>
    <v-dialog v-model="dialog" max-width="500px">
        <v-card>
            <v-card-title>Pet</v-card-title>
            <v-card-text>
                <v-text-field v-model="pet_name" label="Nome" type="text"></v-text-field>
                <v-autocomplete v-model="pet_animal_type"
                    ref="pet_animal_type"
                    :items="animal_types.values"
                    :rules="[() => !!pet_animal_type || 'This field is required']"
                    label="Tipo"></v-autocomplete>
                <v-text-field v-model="pet_age" label="Idade" type="number"></v-text-field>
            </v-card-text>
            <v-card-actions>
                <v-btn color="primary" @click="savePet">Salvar</v-btn>
                <v-btn text @click="closeDialog">Cancelar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        name: "DialogPetForm",
        data: () => ({
            animal_types: [],
            pet_age: '',
            pet_animal_type: '',
            pet_name: '',
        }),
        props: {
            modelValue: {
                type: Boolean,
                required: true
            }
        },
        computed: {
            dialog: {
                get() {
                    return this.modelValue;
                },
                set(value) {
                    this.$emit('update:modelValue', value);
                }
            }
        },
        mounted() {
            this.fetchAnimalTypes();
        },
        methods: {
            closeDialog() {
                this.dialog = false;
            },
            async fetchAnimalTypes() {
                try {
                    const response = await axios.get('/api/pets/animal_types');
                    this.animal_types = response.data;
                } catch (error) {
                    console.error("Erro ao buscar animal_types: ", error);
                }
            }
        },
    }
</script>