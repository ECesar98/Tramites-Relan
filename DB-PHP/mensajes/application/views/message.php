<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="shorcut icon" type="image/x-icon" href="LogoT.ico">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bandeja de entrada</title>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">      
  </head>
  <style>
  body { padding-top: 70px; 
    margin:0; 
    background:url(<?php echo base_url('assets/images/fondo.jpg');?>) no-repeat fixed center; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
  }
  
  #load { height: 100%; width: 100%; }
  #load {
    position    : fixed;
    z-index     : 99999; /* or higher if necessary */
    top         : 0;
    left        : 0;
    overflow    : hidden;
    text-indent : 100%;
    font-size   : 0;
    opacity     : 0.6;
    background  : #E0E0E0  url(<?php echo base_url('assets/images/load.gif');?>) center no-repeat;
  }
  
  .RbtnMargin { margin-left: 5px; }
  
  
  </style>
  <body>
    <div id="load">Espere un momento ...</div>
    <audio id="notif_audio"><source src="<?php echo base_url('sounds/notify.ogg');?>" type="audio/ogg"><source src="<?php echo base_url('sounds/notify.mp3');?>" type="audio/mpeg"><source src="<?php echo base_url('sounds/notify.wav');?>" type="audio/wav"></audio>

<nav class="navbar navbar-inverse navbar-fixed-top " role="navigation">
  <div class="container">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?php echo base_url();?>message">
    Archivos enviados</a>
  </div>
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav nav-pills pull-right" role="tablist">
      <a class="navbar-brand">Nuevos Tramites <span class="badge" id="new_count_message"><?php echo $this->db->where('read_status',0)->count_all_results('message');?></span></a>
    </ul>
  </div>

  </div>
</nav>
    
<div class="container">


<div id="new-message-notif"></div>
  <div class="row">
     <div class="table-responsive">
        <table id="mytable" class="table table-bordred table-striped">
          <thead>
            <th>Remitente</th>
            <th>dni</th>
            <th>Cod: Siagie</th>
            <th>Celular</th>
            <th>Institucion</th>
            <th>Email</th>
            <th>Asunto</th>
            <th>Fecha</th>
            <th>Leer</th>
          </thead>
       
          <tbody id="message-tbody">
               
    <?php
              
       if($message->num_rows() > 0){
            
          foreach($message->result() as $row){  
          if($row->read_status==0) {      
    ?>
         <tr id="msj<?php echo $row->id;?>" style="font-weight: bold;">
            <td><?php echo $row->name;?></td>
            <td><?php echo $row->dni;?></td>
             <td><?php echo $row->codsiage;?></td>
              <td><?php echo $row->celular;?></td>
               <td><?php echo $row->nbcolegio;?></td>
            <td><?php echo $row->email;?></td>
            <td><?php echo $row->subject;?></td>
            <td><?php echo $row->created_at;?></td>
            <td><a style="cursor:pointer" data-toggle="modal" data-target=".bs-example-modal-sm" class="detail-message" id="<?php echo $row->id;?>" onclick="delStyle('msj<?php echo $row->id;?>')"><span class="glyphicon glyphicon-eye-open"></span></a></td>         
          </tr>
    <?php 
          }else{?>
          <tr id="msj<?php echo $row->id;?>" style="font-weight: normal;">
            <td><?php echo $row->name;?></td>
            <td><?php echo $row->dni;?></td>
            <td><?php echo $row->codsiage;?></td>
            <td><?php echo $row->celular;?></td>
            <td><?php echo $row->nbcolegio;?></td>
            <td><?php echo $row->email;?></td>
            <td><?php echo $row->subject;?></td>
            <td><?php echo $row->created_at;?></td>
            <td><a style="cursor:pointer" data-toggle="modal" data-target=".bs-example-modal-sm" class="detail-message" id="<?php echo $row->id;?>"><span class="glyphicon glyphicon-eye-open"></span></a></td>         
          </tr>

    <?php }         
          }              
              
       } else {
              
    ?>
              
              <tr id="no-message-notif">
                <td colspan="5" align="center"><div class="alert alert-danger" role="alert">
                  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                  <span class="sr-only"></span> Ningún mensaje</div>
                </td>
              </tr>
              
    <?php
       }
    ?>
        
           </tbody>
    </table>

    </div>

  </div>
</div>


<hr>
<footer class="text-center">Tramites Relan  &copy 2017</footer>
<hr>

  <script type="text/javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
  <script type="text/javascript" charset="utf8" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script type="text/javascript" charset="utf8" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js"></script>
  <script type="text/javascript" charset="utf8" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/vfs_fonts.js"></script>
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
	<script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>
	<script>
  $(document).ready(function(){

    $('#mytable').DataTable({  
        "order": [[ 3, "desc" ]],          
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        dom: 'Bfrtip',        
        buttons: [        
          {
            text: '<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-duplicate"></span> Copiar</button> ',
            extend:'copy'
          },
            {
            text: '<button type="button" class="btn btn-success"><span class="glyphicon glyphicon-compressed"></span> CSV</button> ',
            extend:'csv'
          },
            {
            text: '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-equalizer"></span> Excel</button> ',
            extend:'excel'
          },
            {
            text: '<button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-copy"></span> PDF</button> ',
            extend:'pdf'
          },
            {
            text: '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-print"></span> Imprimir</button> ',
            extend:'print'
          }
        ]
    } );
    
		$("#load").hide();

     $(document).on("click",".detail-message",function() {
      
      $( "#load" ).show();

       var dataString = { 
              id : $(this).attr('id')
            };

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('message/detail');?>",
            data: dataString,
            dataType: "json",
            cache : false,
            success: function(data){

              $( "#load" ).hide();             


              if(data.success == true){                                
                $("#show_name").html(data.name);
                $("#show_dni").html(data.dni);
                $("#show_codsiage").html(data.codsiage);
                $("#show_celular").html(data.celular);
                $("#show_nbcolegio").html(data.nbcolegio);
                $("#show_email").html(data.email);
                $("#show_subject").html(data.subject);
                $("#show_message").html(data.message);
                                 

                var socket = io.connect( 'http://'+window.location.hostname+':3000' );
                
                socket.emit('update_count_message', { 
                  update_count_message: data.update_count_message
                });

              } 
          
            } ,error: function(xhr, status, error) {
              alert(error);
            },

        });

    });

  });

  var socket = io.connect( 'http://'+window.location.hostname+':3000' );

  socket.on( 'new_count_message', function( data ) {
  
      $( "#new_count_message" ).html( data.new_count_message );
      $('#notif_audio')[0].play();

  });

  socket.on( 'update_count_message', function( data ) {      
      $( "#new_count_message" ).html( data.update_count_message );
      if(data.update_count_message==0){
        $( "#new-message-notif" ).hide();
      }else{
         $( "#new-message-notif" ).hide();
         $( "#new-message-notif" ).html('<div class="alert alert-success" role="alert"> <i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Aún tiene mensajes sin leer</div>');   
         $( "#new-message-notif" ).show();     
      }    
  });

  socket.on( 'new_message', function( data ) {
  
      $( "#message-tbody" ).prepend('<tr id="'+data.id+'" style="font-weight: bold;"><td>'+data.name+'</td><td>'+data.email+'</td><td>'+data.subject+'</td><td>'+data.created_at+'</td><td><a style="cursor:pointer" data-toggle="modal" data-target=".bs-example-modal-sm" class="detail-message" id="'+data.id+'" onclick="delStyle('+data.id+')"><span class="glyphicon glyphicon-eye-open"></span></a></td></tr>');
      $( "#no-message-notif" ).html('');
      $( "#new-message-notif" ).html('<div class="alert alert-success" role="alert"> <i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Nuevo mensaje ...</div>');
  });

  function delStyle(di){  
  var di = di;    
  $("#"+di).removeAttr("style");
  };

</script>
  </body>
</html>

        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">✕</button>
                      <h4>Detalles del mensaje</h4>
                  </div>
                  
                  <div class="modal-body" style="text-align:center;">
                    <div class="row-fluid">
                     <div class="span10 offset1">
                       <div id="modalTab">
                         <div class="tab-content">
                           <div class="tab-pane active" id="about">

                            <center>
                             <p class="text-left">
                              <b>Nombre</b> : <span id="show_name"></span><br />
                              <b>Dni</b> : <span id="show_dni"></span><br />
                              <b>Cod Siagie</b> : <span id="show_codsiage"></span><br />
                              <b>Celular</b> : <span id="show_celular"></span><br />
                              <b>Institución</b> : <span id="show_nbcolegio"></span><br />
                              <b>Email</b> : <span id="show_email"></span><br />
                              <b>Asunto</b> : <span id="show_subject"></span><br />
                              <b>Mensaje</b> : <span id="show_message"></span><br />
                              
                             </p>
                             <br>
                           </center>
                  
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>