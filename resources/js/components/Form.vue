<template>
 <v-container>
           
                <form>
                   <v-text-field
      v-model="siapa"
      :error-messages="siapaErrors"
    
      label="Nama"
      required
      @input="$v.siapa.$touch()"
      @blur="$v.siapa.$touch()"
    ></v-text-field>
                     <v-select
      v-model="kabupaten_kota"
      :items="items"
      :error-messages="selectErrors"
      label="Kabupaten/Kota"
      required
      @change="$v.kabupaten_kota.$touch()"
      @blur="$v.kabupaten_kota.$touch()"
    ></v-select>
    <!-- <v-text-field
      v-model="judul"
      :error-messages="judulErrors"
  
      label="Judul"
      required
      @input="$v.judul.$touch()"
      @blur="$v.judul.$touch()"
    ></v-text-field> -->
    
    <v-textarea
          name="input-7-1"
          label="Pertanyaan"
           :error-messages="pertanyaanErrors"
 v-model="pertanyaan"
      required
      @input="$v.pertanyaan.$touch()"
      @blur="$v.pertanyaan.$touch()"
          hint="Silakan tulis pertanyaan Anda"
        ></v-textarea>

    <v-btn class="mr-4" @click="submit">submit</v-btn>
    <v-btn @click="clear">clear</v-btn>
  </form>

  
          
        </v-container>
 
</template>


<script>
  import { validationMixin } from 'vuelidate'
  import { required, maxLength, email } from 'vuelidate/lib/validators'

  export default {
    mixins: [validationMixin],

    validations: {
      name: { required, maxLength: maxLength(10) },
      email: { required, email },
      select: { required },
      // judul: {required},
      siapa: {required},
      pertanyaan: {required},
      kabupaten_kota: {required},
      checkbox: {
        checked (val) {
          return val
        },
      },
    },

    data: () => ({
      name: '',
      // judul: '',
      siapa: '',
      pertanyaan: '',
      kabupaten_kota: null,
      items: [
        'Banggai',
        'Banggai Kepulauan',
        'Banggai Laut',
        'Morowali',
        'Morowali Utara',
        'Poso',
        'Donggala',
        'Toli-toli',
        'Buol',
        'Parigi Moutong',
        'Tojo Una-una',
        'Sigi',
        'Palu'

      ],
      checkbox: false,
    }),

    computed: {
      
      kabupaten_kotaErrors () {
        const errors = []
        if (!this.$v.kabupaten_kota.$dirty) return errors
        !this.$v.kabupaten_kota.required && errors.push('Tidak boleh kosong')
        return errors
      },
      // judulErrors () {
      //   const errors = []
      //   if (!this.$v.judul.$dirty) return errors
      //   !this.$v.judul.required && errors.push('Tidak boleh kosong')
      //   return errors
      // },
      siapaErrors () {
        const errors = []
        if (!this.$v.siapa.$dirty) return errors
        !this.$v.siapa.required && errors.push('Tidak boleh kosong')
        return errors
      },
      pertanyaanErrors () {
        const errors = []
        if (!this.$v.pertanyaan.$dirty) return errors
        !this.$v.pertanyaan.required && errors.push('Tidak boleh kosong')
        return errors
      },
    },

    methods: {
      async submit () {
        this.$v.$touch()

       
                if (
                    // this.judul === null ||
                    this.siapa === null ||
                    this.kabupaten_kota === null ||
                    this.pertanyaan === null

                ) {
                    this.snackbar = true

                } else {
                    
                    

                    this.$store.state.loader = true;
                    await axios.post('/pertanyaan', {
                            
                            // judul: this.judul,
                    siapa: this.siapa,
                    kabupaten_kota: this.kabupaten_kota,
                    pertanyaan: this.pertanyaan 
                        })
                        .then(function (response) {
                            console.log(response);
                        })
                   
                    this.clear()
                }

      },
      clear () {
        this.$v.$reset()
        // this.judul = ''
        this.siapa = ''
        this.pertanyaan = ''
        this.kabupaten_kota = false
      },
    },
  }
</script>