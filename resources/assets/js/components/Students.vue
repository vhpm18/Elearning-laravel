<template>
    <div>
        <modal :showModal="showModal" @ocultar="showModal=false" :rowClick="rowClick"></modal>
        <div class="alert alert-primary text-center" v-if="processing">
            <i class="fa fa-compass"></i> Procesando petición
        </div>
        <v-server-table ref="table" :columns="columns" :url="url" :options="options" >
            <div slot="name" slot-scope="props">
                {{ props.row.name }}
            </div>
            <div slot="email" slot-scope="props">
                {{ props.row.email }}
            </div>
            <div slot="created_at" slot-scope="props">
                {{ formattedDate(props.row.created_at) }}
            </div>
            <template slot="picture" slot-scope="props">
                <img :src="formattedImg(props.row.picture)" alt="" width="50" height="50" class="img-thumbnail">
            </template>
            <div slot="message" slot-scope="props">
                <i :data-id="props.row.id" class="btn btn-primary btnEmail fa fa-envelope-square" id="show-modal" v-on:click="loadDataUser(props.row)"></i>
            </div>
        </v-server-table>
    </div>
</template>
<script>
import {EventBus} from '../event-bus';
import Moment from 'moment'
import Modal from '../components/Modal';
export default {
    components: { Modal, Moment },
    name: 'teachers',
    props: {
        labels: {
            type: Object,
            required: true
        },
        route: {
            type: String,
            required: true
        },
    },

    data() {
        return {
            showModal: false,
            rowClick: 0,
            id: 0,
            processing: false,
            url: this.route,
            columns: ['id', 'picture', 'name', 'email', 'created_at', 'message'],
            options: {
                filterByColumn: true,
                perPage: 10,
                texts: {
                    filter: "Filtrar:",
                    filterBy: 'Filtrar por {column}',
                    count:' '
                },
                perPageValues: ['10', '25', '50', '100', '500'],
                headings: {
                    'id': 'ID',
                    'picture': this.labels.picture,
                    'name': this.labels.name,
                    'email': this.labels.email,
                    'created_at': this.labels.created_at,
                    'message': this.labels.message,
                },
                sortable: ['id', 'name', 'email'],
                filterable: ['name', 'email'],
                requestFunction: function(data) {
                    return window.axios.get(this.url, {
                        params: data
                    })
                    .catch(function(e) {
                        this.dispatch('error', e);
                    }.bind(this));
                }
            }

        };
    },

    methods: {
        formattedDate(created_at) {
            Moment.locale('es');
            return Moment(created_at).format('LL');
        },
        formattedImg(picture) {
            return `/images/users/${picture}`;
        },
        loadDataUser(row) {
            EventBus.$emit('rowClick', row);
            EventBus.$emit('btnSend', false);
            this.rowClick = row;
            this.showModal = true;
        },
    },
// emitRowClick: function emitRowClick(row) {
//   console.log(row);
//   this.$emit('rowClick', rowClick);
// }

};

</script>
<style lang="css">
.VueTables__date-filter {
  border: 1px solid #ccc;
  padding: 6px;
  border-radius: 4px;
  cursor: pointer;
}
</style>
