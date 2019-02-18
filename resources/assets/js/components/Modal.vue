<template>
    <div v-if="showModal" id="appModal">
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Enviar mensaje a:
                                    <span class="State State--small ml-1 State--purple float-right">{{ user_name }}</span>
                                </h4>
                                <button type="button" class="close" @click="cerrarModal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-5 alert alert-success" v-if="processing">
                                    <strong>Información!</strong>
                                    {{ alert_info }}
                                </div>
                                <form id='sendMessage'>
                                    <input type="hidden" name="user_id" value="" v-model="user_id">
                                    <textarea id="message" class="form-control" placeholder="Escribe tu mensaje" v-model.trim="message"></textarea>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button id="modalAction" type="button" class="btn btn-primary" @click="sendMessageUser(user_id)" v-if="buttonSend" enabled="enabled">Enviar Mensaje</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cerrarModal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>
<script>
import {EventBus} from '../event-bus';
export default {
    name: 'modal',
    props: ['showModal','rowClick','btnSend'],
    data() {
        return {
            user_id:0,
            typeUser:0,
            user_name: String,
            processing: false,
            alert_info:'',
            message:'',
            buttonSend: true,
        };
    },
    methods: {
        cerrarModal() {
            this.$emit('ocultar');
        },
        sendMessageUser(user_id){
            let modal = $("#appModal");
            if (this.message === '') {
                this.processing = true;
                this.alert_info = 'No puede enviar un mensaje vacio';
                modal.find('#modalAction').text('Enviando mensaje...').attr('disabled','disabled');
                setTimeout(() =>{
                    this.processing = false;
                    modal.find('#modalAction').text('Enviar mensaje').removeAttr('disabled');
                },1000);
            }else{
                if(this.message !== ''){
                    this.processing = true;
                    this.alert_info = 'Mensaje enviado correctamente';
                    this.buttonSend =false;
                }
                setTimeout(() => {
                    this.$http.post(
                        '/admin/sendMessage',
                        { user_id: user_id, message: this.message, typeUser:3},
                        {
                            headers: {
                                'x-csrf-token': document.head.querySelector('meta[name=csrf-token]').content
                            }
                        }
                        ).then(response => {
                            if(response.data.res){
                                this.$emit('ocultar');
                                this.message='';
                                console.log(response.data.res);
                            }

                      //this.$refs.table.refresh();
                  })
                        .catch(error => {
                            console.log(error);
                        })
                        .finally(() => {
                            this.processing = false;
                            this.buttonSend =true;
                        });

                    }, 1500)

            }
        }
    },
    created () {
        EventBus.$on('rowClick', (data) => {
          this.user_id = data.id;
          this.user_name =  data.name;
      })
        EventBus.$on('btnSend', (data) => {
          if(data)
              this.buttonSend = true;
      })
    },
};

</script>
<style lang="css">
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .5);
    display: table;
    transition: opacity .3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}
.State--small {
    font-size: 12px;
    padding: .125em 4px;
}
.State--purple {
    background-color: #6f42c1;
}
.state, .State {
    /*background-color: #6a737d;*/
    border-radius: 3px;
    color: #fff;
    display: inline-block;
    font-weight: 600;
    line-height: 20px;
    padding: 4px 8px;
    text-align: center;
}
.ml-1 {
    margin-left: 4px !important;
}
.float-right {
    float: right !important;
}

</style>
