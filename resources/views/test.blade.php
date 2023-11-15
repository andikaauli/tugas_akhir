<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="<?php echo asset('style.css')?>">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
                                .bandeau{
		            			color: #198eba;
		            			font-weight: bold;
                      text-align: center;
                      font-size: 200%;
		            		}

                    .size{
                      color: #198eba;
		            			font-weight: bold;
                      text-align: center;
                      font-size: 50%;
                    }

		            		.tableauRecap{
		            			width:100%;
		            		}

		            		.tableauSyntheseP3 thead{
		            			color: #2393bd;
    							    text-align: center;
    							    background-color: #eeece0;
		            		}

		            		.tableauSyntheseP3 thead td{
		            			border-bottom:2px solid #DDDDDD;
		            		}

		            		.tableauSyntheseP3 thead th{
		            			border-bottom:2px solid #DDDDDD;
                      width: 33%;
                      font-weight: bold;
                      font-size: 150%;
		            		}

		            		.tableauSyntheseP3 tbody{
		            			margin: 1px;
		            			text-align: center;
                      color: blue;
		            		}


		            		.tableauSyntheseP3 tbody td{
		            			border-bottom:2px solid #DDDDDD;
		            			border-left:2px solid #DDDDDD;
		            			border-right:2px solid #DDDDDD;
		            		}

		            		.tableauSyntheseP3{
		            			width:100%;
		            			border-collapse: collapse;
		            		}

		            		.paginate_button_not_current{
		            				background: none;
                        padding: 0;
                        font-weight: bold;
                        color: #2b93ba;
                        width: 15px;
                        height: 14px;
                        border: 1px solid #959494;
                        vertical-align: top;
                        display: inline-block;
                        min-width: 1.5em;
                        margin-left: 2px;
                        text-align: center;
                        text-decoration: none;
                        cursor: pointer;
		            		}

		            		.paginate_button_current{
		            	background-color: #2b93ba;
                  background-image: none;
                  border: 1px solid #959494;
                  width: 15px;
                  height: 14px;
                  color: #ffffff;
                  font-family: Arial;
                  display: inline-block;
                  min-width: 1.5em;
                  margin-left: 2px;
                  text-align: center;
                  text-decoration: none;
                  cursor: pointer;
		            }

		           .alignPaginationRight{
		            	float: right;
		           }

		           .blocPagination{
		            	padding-bottom: 15px;
		           }


              .pair{
                background-color: grey;
              }

              .impair{
                background-color: lightgrey;
              }

        </style>

        <style>
            body {
                font-family: 'quicksand';
            }
        </style>
        @vite('resources/css/app.css')
</head>
<body class="">
    <div id="ConteneurTabDiv">
        <div class="bandeau">Bandeau (Titre du tableau)
        <div class="size">Nb elements / pagination : <input type="text" name="fname" id="size" style="text-align:center;" onchange="changeSize();" value="2"></div>
      </div>
      <br/>
        <div id="monArray_TBL" class="tableauRecap">

          <table class="tableauSyntheseP3">

            <thead>

              <tr>
                <th>Nom</th>
                <th>Age</th>
                <th>Sexe</th>
              </tr>

           </thead>

           <tbody>

              <tr class="pair">
                <td>Polo</td>
                <td>19</td>
                <td>M</td>
              </tr>

              <tr class="impair">
                <td>Maria</td>
                <td>21</td>
                <td>F</td>
              </tr>

              <tr class="pair">
                <td>Jeanne</td>
                <td>16</td>
                <td>F</td>
              </tr>

              <tr class="impair">
                <td>Pistou</td>
                <td>54</td>
                <td>M</td>
              </tr>

              <tr class="pair">
                <td>Pierre</td>
                <td>34</td>
                <td>M</td>
              </tr>

              <tr class="impair">
                <td>Samantha</td>
                <td>24</td>
                <td>F</td>
              </tr>

              <tr class="pair">
                <td>Julie</td>
                <td>41</td>
                <td>F</td>
              </tr>

              <tr class="impair">
                <td>François</td>
                <td>71</td>
                <td>M</td>
              </tr>

             <tr class="pair">
                <td>Alain</td>
                <td>47</td>
                <td>M</td>
              </tr>

            </tbody>

          </table>

       <br/>
            <div class="alignPaginationRight" id="paginationMonArray"></div>
         <br/>

      </div>
      <br/>
    </div>
</body>
</html>

<script>
              /**
			     * Fonction utilitaire, Fonction permettant le changement du paramètre "size" utilisé dans la fonction de pagination
			     */
                 function changeSize(){
            //On recupere le paramètre dans le HTML
            var size = document.getElementById("size").value;
            if(isNaN(size)){
               alert('la taille doit être au format numérique !!!');
               //On clean la pagination
			         $("#paginationMonArray").html("");
               //On repagine avec la bonne taille!
               pagination("#paginationMonArray","#monArray_TBL",9);
            }else{
               //On clean la pagination
			         $("#paginationMonArray").html("");
               //On repagine avec la bonne taille!
               pagination("#paginationMonArray","#monArray_TBL",size);
            }
          }

          /**
			     * Fonction utilitaire, Fonction permettant la pagination des tableaux HTML
			     */
			    function pagination(id,tabID,size){

            //On supprime les elements ajoutes lors d'une precedante utilisation de la pagination
            $( ".removable" ).remove();

			    	//INITIALISATION DE LA PAGINATION
            var nb_elem=parseInt(size);
            var $tr=jQuery(tabID+' tbody tr');
            var total_elem_tableau=$tr.length;

            if(nb_elem <= 0){
              alert('la taille doit être supérieure ou égale à 1 !!!');
              nb_elem = total_elem_tableau;
            }

            var num_pages=0;
            var modulo = true;
            var tmpDebut = [];
            tmpDebut[0] = 0;

            if(total_elem_tableau % nb_elem == 0){
              num_pages=total_elem_tableau / nb_elem;
            }

            if(total_elem_tableau % nb_elem >=1){
              num_pages=total_elem_tableau / nb_elem;
              num_pages=Math.floor(num_pages+1);
              modulo = false;

              //Nombre de pages à ajouter
              nb_page_toAdd = (size | 0) - (total_elem_tableau % nb_elem);
              //console.log("nb_page_toAdd = "+nb_page_toAdd);
              //console.log("size = "+size);
              if( (size | 0) !== nb_page_toAdd && (size | 0) < (total_elem_tableau | 0) ){
                while(nb_page_toAdd > 0){
                  if(nb_page_toAdd % 2 == 0){
                     $(tabID).find("tbody").append("<tr class='pair removable'><td>Null</td><td>Null</td><td>Null</td></tr>");
                  }else{
                     $(tabID).find("tbody").append("<tr class='impair removable'><td>Null</td><td>Null</td><td>Null</td></tr>");
                  }
                  nb_page_toAdd--;
                }
              }

              //On recalcule le $tr
              $tr=jQuery(tabID+' tbody tr');
            }


            for(var i=0; i<=num_pages+1; i++){
              if(i == 0){
                jQuery(id).append("<a class='paginate_button_not_current' href=''>-</a>");
              }else if(i == 1){
                jQuery(id).append("<a class='paginate_button_current' href=''>"+i+"</a>");
              }else if(i == num_pages+1){
                jQuery(id).append("<a class='paginate_button_not_current' href=''>+</a>");
              }else{
                jQuery(id).append("<a class='paginate_button_not_current' href=''>"+i+"</a>");
              }
            }

            //On désactive le bouton "-" au début!
            jQuery(id+' a:nth-child(1)').css( 'cursor', 'not-allowed' );


            $tr.each(function(i){
              jQuery(this).hide();
              if(i+1 <= nb_elem){
                $tr.eq(i).show();
              }
            });

            //CAS DU CLIC SUR LE MENU DE PAGINATION SITUE SOUS LE TABLEAU!
            jQuery(id+' a').click(function(e){
              e.preventDefault();
              var page=jQuery(this).text();
              var temp;
              var debut;

              //SOIT ON RECOIT UNE PAGE (INT) SOIT ON RECOIT PRECEDANT '-' OU SUIVANT '+'
              if(isNaN(page)){
                debut = tmpDebut[0];
              }else{
                temp=page-1;
                debut= temp * nb_elem;
                tmpDebut[0] = debut;
              }

              //console.log(debut);
              //console.log(nb_elem*(num_pages-1));

              for(var i=0; i< nb_elem; i++){
                if(isNaN(page) && page === "-" && debut !== 0){
                  //CAS PRECEDANT
                  if(i == 0){
                    $tr.hide();
                    tmpDebut[0] = tmpDebut[0] - nb_elem;
                    if(tmpDebut[0] === 0){
                      jQuery(id+' a:nth-child(1)').css( 'cursor', 'not-allowed' );
                    }
                  }
                  $tr.eq(tmpDebut[0]+i).show();
                }else if(isNaN(page) && page === "-" && debut === 0){
                  return;
                }else if(isNaN(page) && page === "+" && debut !== nb_elem*(num_pages-1) && modulo == true){
                  //CAS SUIVANT nb_elem%total == 0
                  if(i == 0){
                    $tr.hide();
                    tmpDebut[0] = tmpDebut[0] + nb_elem;
                  }
                  $tr.eq(tmpDebut[0]+i).show();
                  if(tmpDebut[0] == nb_elem*(num_pages-1)){
                    jQuery(id+' a:nth-child('+(num_pages+2)+')').css( 'cursor', 'not-allowed' );
                  }
                }else if(isNaN(page) && page === "+" && debut !== nb_elem*(num_pages-1) && modulo == false){
                  //CAS SUIVANT  nb_elem%total > 0
                  if(i == 0){
                    $tr.hide();
                    tmpDebut[0] = tmpDebut[0] + nb_elem;
                  }
                  $tr.eq(tmpDebut[0]+i).show();
                  if(tmpDebut[0] == nb_elem*(num_pages-1)){
                    jQuery(id+' a:nth-child('+(num_pages+2)+')').css( 'cursor', 'not-allowed' );
                  }
                }else if(isNaN(page) && page === "+" && debut === nb_elem*num_pages && modulo == true){
                  return;
                }else if(isNaN(page) && page === "+" && debut === nb_elem*(num_pages-1) && modulo == false){
                  return;
                }else if(isNaN(page) == false){
                  //CAS NORMAL
                  if(i==0) $tr.hide();
                  $tr.eq(debut+i).show();
                }
              }

              //GESTION DU CURSEUR
              if(tmpDebut[0] !== 0){
                jQuery(id+' a:nth-child(1)').css( 'cursor', 'pointer' );
              }else{
                jQuery(id+' a:nth-child(1)').css( 'cursor', 'not-allowed' );
              }

              if(tmpDebut[0] !== nb_elem*(num_pages-1)){
                jQuery(id+' a:nth-child('+(num_pages+2)+')').css( 'cursor', 'pointer' );
              }else{
                jQuery(id+' a:nth-child('+(num_pages+2)+')').css( 'cursor', 'not-allowed' );
              }

              //GESTION DE LA PAGE SELECTIONNEE
              for(var i=1; i<=num_pages+1; i++){
                if( i == (tmpDebut[0]/nb_elem)+1 ){
                  jQuery(id+' a:nth-child('+(i+1)+')').attr('class', 'paginate_button_current');
                }else{
                  jQuery(id+' a:nth-child('+(i+1)+')').attr('class', 'paginate_button_not_current');
                }
              }


            });
				}



  //On initialisa à l'arrache!
  start = true;
  if(start == true) changeSize();

</script>
