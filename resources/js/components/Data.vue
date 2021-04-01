<template>
    <v-container>
        <v-card elevation=8 class=" pa-md-4 mx-lg-auto">
            <v-list-item three-line>
                <v-list-item-content>
                    <div class="overline mb-4">Forum Sensus Penduduk 2020 Sulawesi Tengah</div>
                    <v-list-item-title class="headline mb-1">Forum Diskusi</v-list-item-title>
                    <v-list-item-subtitle>Silakan bertanya apa saja mengenai Sensus Penduduk 2020</v-list-item-subtitle>
                </v-list-item-content>

                <v-list-item-avatar tile size="120" color="grey">
                    <v-img height="100%"
                        src="https://asset.kompas.com/crops/Gb117UsO-JZ19unfXdzCAddKYWw=/0x7:730x494/750x500/data/photo/2020/02/29/5e5a2daf777ca.png">
                    </v-img>
                </v-list-item-avatar>
            </v-list-item>

            <v-card-actions>


                <v-btn color="primary" dark @click="dialog_pertanyaan_x = true">
                    Tanya
                </v-btn>

                <!--     -->

            </v-card-actions>
            <br>
            <v-dialog v-model="dialog_pertanyaan_x" persistent max-width="600px">
                <v-card>
                    <v-card-title>
                        <span class="headline">Pertanyaan Baru</span>
                    </v-card-title>
                    <v-card-text>
                        <s-form></s-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="primary" text @click="dialog_pertanyaan_x = false">
                            Close
                        </v-btn>
                    </v-card-actions>



                </v-card>
            </v-dialog>

            <v-container>
                <v-data-iterator data-app :items="items" :items-per-page.sync="itemsPerPage" :page="page"
                    :search="search" :sort-by="sortBy.toLowerCase()" :sort-desc="sortDesc" hide-default-footer>
                    <template v-slot:header>
                        <v-toolbar dark color="blue darken-3" class="mb-1">
                            <v-text-field v-model="search" clearable flat solo-inverted hide-details label="Search">
                            </v-text-field>
                            <template v-if="$vuetify.breakpoint.mdAndUp">
                                <v-spacer></v-spacer>
                                <v-select v-model="sortBy" flat solo-inverted hide-details :items="keys"
                                    label="Sort by">
                                </v-select>
                                <v-spacer></v-spacer>
                                <v-btn-toggle v-model="sortDesc" mandatory>
                                    <v-btn large depressed color="blue" :value="false">
                                        <v-icon>mdi-arrow-up</v-icon>
                                    </v-btn>
                                    <v-btn large depressed color="blue" :value="true">
                                        <v-icon>mdi-arrow-down</v-icon>
                                    </v-btn>
                                </v-btn-toggle>
                            </template>
                        </v-toolbar>
                    </template>

                    <template v-slot:default="props">
                        <v-row>
                            <v-col v-for="item in props.items" :key="item.id" cols="12" sm="6" md="6" lg="12">
                                <!-- <v-card>
                                    <v-card-title class="subheading font-weight-bold">{{ item.judul }}</v-card-title>

                                    <v-divider></v-divider>

                                    <v-list dense>
                                        <v-list-item v-for="(key, index) in filteredKeys" :key="index">
                                            <v-list-item-content :class="{ 'blue--text': sortBy === key }">{{ key }}:
                                            </v-list-item-content>
                                            <v-list-item-content class="align-end"
                                                :class="{ 'blue--text': sortBy === key }">
                                                {{ item[key.toLowerCase()] }}</v-list-item-content>
                                        </v-list-item>
                                    </v-list>
                                </v-card> -->

                                <v-card>
                                    <!-- <v-card-title class="subheading font-weight-bold">{{ item.judul }}
                                    </v-card-title> -->
                                     <v-card-title class="headline">Pertanyaan</v-card-title>

                                    <v-card-subtitle>{{item.pertanyaan}}</v-card-subtitle>
                                    
                                   

                                    <v-divider></v-divider>
                                    <v-card-title class="headline">Jawaban</v-card-title>                                  

                                    <v-card-subtitle>{{item.jawaban}}</v-card-subtitle>
                                    <!-- <v-expansion-panels v-model="panel" :readonly="readonly" multiple>
                                        <v-expansion-panel>
                                            <v-expansion-panel-header>{{item.jawaban.substring(0,140)}}
                                            </v-expansion-panel-header>
                                            <v-expansion-panel-content>
                                                {{item.jawaban}}
                                            </v-expansion-panel-content>
                                        </v-expansion-panel>
                                    </v-expansion-panels> -->







                                    <!-- <v-list-item>
                                            <v-list-item-content>
                                                <v-list-item-title>Pertanyaan</v-list-item-title>
                                                <v-list-item-subtitle>{{item.pertanyaan}}</v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>

                                        <v-list-item>
                                            <v-list-item-content>
                                                <v-list-item-title>Jawaban</v-list-item-title>
                                                <v-list-item-subtitle>{{item.jawaban}}</v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item> -->







                                     <v-chip class="ma-2" color="indigo" text-color="white" small>
                                        <v-avatar left>
                                            <v-icon>mdi-account-circle</v-icon>
                                        </v-avatar>
                                        {{ item.siapa }}
                                    </v-chip>

                                    <v-chip class="mr-2" color="red" text-color="white" small >
                                        <v-avatar left>
                                            <v-icon>mdi-map</v-icon>
                                        </v-avatar>
                                        <div v-if="item.kabupaten_kota_id == 1 " class="align-end">
                                            Banggai
                                        </div>

                                        <div v-if="item.kabupaten_kota_id == 2 " class="align-end">
                                            Banggai Kepulauan
                                        </div>

                                        <div v-if="item.kabupaten_kota_id == 3 " class="align-end">
                                            Banggai Laut
                                        </div>

                                        <div v-if="item.kabupaten_kota_id == 4 " class="align-end">
                                            Buol
                                        </div>

                                        <div v-if="item.kabupaten_kota_id == 5 " class="align-end">
                                            Donggala
                                        </div>

                                        <div v-if="item.kabupaten_kota_id == 6 " class="align-end">
                                            Morowali
                                        </div>

                                        <div v-if="item.kabupaten_kota_id == 7 " class="align-end">
                                            Morowali Utara
                                        </div>

                                        <div v-if="item.kabupaten_kota_id == 8 " class="align-end">
                                            Parigi Moutong
                                        </div>

                                        <div v-if="item.kabupaten_kota_id == 9 " class="align-end">
                                            Poso
                                        </div>

                                        <div v-if="item.kabupaten_kota_id == 10 " class="align-end">
                                            Sigi
                                        </div>

                                        <div v-if="item.kabupaten_kota_id == 11 " class="align-end">
                                            Tojo Una-una
                                        </div>

                                        <div v-if="item.kabupaten_kota_id == 12 " class="align-end">
                                            Toli-toli
                                        </div>

                                        <div v-if="item.kabupaten_kota_id == 13 " class="align-end">
                                            Palu
                                        </div>
                                    </v-chip>
                                    <v-chip class="mr-2">
                                        <!-- <v-icon left>mdi-brightness-5</v-icon> -->
                                        {{item.updated_at.substring( 0, 10)}}
                                    </v-chip>




                                </v-card>
                            </v-col>
                        </v-row>
                    </template>

                    <template v-slot:footer>
                        <v-row class="mt-2" align="center" justify="center">
                            <span class="grey--text">Items per page</span>
                            <v-menu offset-y>
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn dark text color="primary" class="ml-2" v-bind="attrs" v-on="on">
                                        {{ itemsPerPage }}
                                        <v-icon>mdi-chevron-down</v-icon>
                                    </v-btn>
                                </template>
                                <v-list>
                                    <v-list-item v-for="(number, index) in itemsPerPageArray" :key="index"
                                        @click="updateItemsPerPage(number)">
                                        <v-list-item-title>{{ number }}</v-list-item-title>
                                    </v-list-item>
                                </v-list>
                            </v-menu>

                            <v-spacer></v-spacer>

                            <span class="mr-4 grey--text">
                                Page {{ page }} of {{ numberOfPages }}
                            </span>
                            <v-btn fab dark color="blue darken-3" class="mr-1" @click="formerPage">
                                <v-icon>mdi-chevron-left</v-icon>
                            </v-btn>
                            <v-btn fab dark color="blue darken-3" class="ml-1" @click="nextPage">
                                <v-icon>mdi-chevron-right</v-icon>
                            </v-btn>
                        </v-row>
                    </template>
                </v-data-iterator>
            </v-container>
        </v-card>
    </v-container>
</template>


<script>
    export default {
        props: ['questions', 'user'],
        data() {
            return {
                dialog: false,
                itemsPerPageArray: [5, 10, 12],
                search: '',
                filter: {},
                sortDesc: false,
                page: 1,
                itemsPerPage: 5,
                sortBy: 'name',
                keys: [
                    'Judul',
                    'Kabupaten_Kota_id',
                    'Siapa',
                    'Pertanyaan',
                    'Jawaban',
                ],
                items: [{
                        judul: 'Kalau Suku itu yang Seperti apa ya? 1a',
                        kabupaten_kota: 159,
                        siapa: 6.0,
                        pertanyaan: 24,
                        jawaban: 4.0,
                    },
                    {
                        judul: 'Kalau Suku itu yang Seperti apa ya? 2a',
                        kabupaten_kota: 159,
                        siapa: 6.0,
                        pertanyaan: 24,
                        jawaban: 4.0,
                    },
                    {
                        judul: 'Kalau Suku itu yang Seperti apa ya? 3a',
                        kabupaten_kota: 159,
                        siapa: 6.0,
                        pertanyaan: 24,
                        jawaban: 4.0,
                    },
                    {
                        judul: 'Kalau Suku itu yang Seperti apa ya? 4a',
                        kabupaten_kota: 159,
                        siapa: 6.0,
                        pertanyaan: 24,
                        jawaban: 4.0,
                    },
                ],

            }
        },
        computed: {
            numberOfPages() {
                return Math.ceil(this.items.length / this.itemsPerPage)
            },
            filteredKeys() {
                return this.keys.filter(key => key !== `Name`)
            },

            dialog_pertanyaan_x: {
                set(val) {
                    this.$store.state.dialog.dialog_pertanyaan = val
                },
                get() {
                    return this.$store.state.dialog.dialog_pertanyaan
                }
            }
        },
        mounted() {
            console.log('a')
            this.getQuestions()
        },
        methods: {
            nextPage() {
                if (this.page + 1 <= this.numberOfPages) this.page += 1
            },
            formerPage() {
                if (this.page - 1 >= 1) this.page -= 1
            },
            updateItemsPerPage(number) {
                this.itemsPerPage = number
            },
            getQuestions() {
                console.log(this.questions)
                this.items = this.questions
            }
        },
    }

</script>
