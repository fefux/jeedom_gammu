<?php

if (!isConnect('admin')) {
    throw new Exception('{{401 - Accès non autorisé}}');
}
sendVarToJS('eqType', 'gammu');
$eqLogics = eqLogic::byType('gammu');

?>

<div class="row row-overflow">
    <div class="col-lg-2 col-md-3 col-sm-4">
        <div class="bs-sidebar">
            <ul id="ul_eqLogic" class="nav nav-list bs-sidenav">
                <a class="btn btn-default eqLogicAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter un équipement}}</a>
                <li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
                <?php
                foreach ($eqLogics as $eqLogic) {
                    echo '<li class="cursor li_eqLogic" data-eqLogic_id="' . $eqLogic->getId() . '"><a>' . $eqLogic->getHumanName(true) . '</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="col-lg-10 col-md-9 col-sm-8 eqLogicThumbnailDisplay" style="border-left: solid 1px #EEE; padding-left: 25px;">
   <legend><i class="fa fa-cog"></i>  {{Gestion}}</legend>
   <div class="eqLogicThumbnailContainer">
     <div class="cursor eqLogicAction" data-action="gotoPluginConf" style="background-color : #ffffff; height : 140px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;">
     <center>
       <i class="fa fa-wrench" style="font-size : 5em;color:#767676;"></i>
     </center>
     <span style="font-size : 1.1em;position:relative; top : 23px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;color:#767676"><center>{{Configuration}}</center></span>
   </div>
 </div>


        <legend><i class="fa fa-table"></i>  {{Mes Gammu}}
        </legend>
            <div class="eqLogicThumbnailContainer">
                      <div class="cursor eqLogicAction" data-action="add" style="background-color : #ffffff; height : 200px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;" >
           <center>
            <i class="fa fa-plus-circle" style="font-size : 7em;color:#00979c;"></i>
        </center>
        <span style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;"><center>Ajouter</center></span>
    </div>
                <?php
                foreach ($eqLogics as $eqLogic) {
                  $opacity = ($eqLogic->getIsEnable()) ? '' : jeedom::getConfiguration('eqLogic:style:noactive');
                    echo '<div class="eqLogicDisplayCard cursor" data-eqLogic_id="' . $eqLogic->getId() . '" style="background-color : #ffffff; height : 200px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;' . $opacity . '" >';
                    echo "<center>";
                    echo '<img src="plugins/gammu/doc/images/gammu_icon.png" height="105" width="95" />';
                    echo "</center>";
                    echo '<span style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;"><center>' . $eqLogic->getHumanName(true, true) . '</center></span>';
                    echo '</div>';
                }
                ?>
            </div>
    </div>


    <div class="col-lg-10 col-md-9 col-sm-8 eqLogic" style="border-left: solid 1px #EEE; padding-left: 25px;display: none;">
      <div class="row">
          <div class="col-sm-6">
    <form class="form-horizontal">
      <fieldset>
        <legend><i class="fa fa-arrow-circle-left eqLogicAction cursor" data-action="returnToThumbnailDisplay"></i> {{Général}}  <i class='fa fa-cogs eqLogicAction pull-right cursor expertModeVisible' data-action='configure'></i></legend>
        <div class="form-group">
          <label class="col-sm-2 control-label">{{Nom de l'équipement Gammu}}</label>
          <div class="col-sm-3">
            <input type="text" class="eqLogicAttr form-control" data-l1key="id" style="display : none;" />
            <input type="text" class="eqLogicAttr form-control" data-l1key="name" placeholder="{{Nom de l'équipement gammu}}"/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" >Objet parent</label>
          <div class="col-sm-3">
              <select class="eqLogicAttr form-control" data-l1key="object_id">
                   <option value="">Aucun</option>
                   <?php
  foreach (object::all() as $object) {
  	echo '<option value="' . $object->getId() . '">' . $object->getName() . '</option>';
  }
  ?>
              </select>
          </div>
       </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" >{{Activer}}</label>
          <div class="col-sm-9">
           <input type="checkbox" class="eqLogicAttr bootstrapSwitch" data-label-text="{{Activer}}" data-l1key="isEnable" checked/>
           <input type="checkbox" class="eqLogicAttr bootstrapSwitch" data-label-text="{{Visible}}" data-l1key="isVisible" checked/>
         </div>
       </div>

    </fieldset>
  </form>
  </div>

  <form class="form-horizontal">
    <fieldset>
        <legend>{{Configuration}}</legend>

        <div class="form-group">
        <label class="col-sm-2 control-label">{{Téléphone}} :</label>
         <div class="col-sm-3">
           <input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="phone" placeholder="{{numéro}}"/>
         </div>
       </div>

       <div class="form-group">
       <label class="col-sm-2 control-label">{{Utilisateur}} :</label>
        <div class="col-sm-3">
          <input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="user" placeholder="{{username}}"/>
        </div>
      </div>

      <div class="form-group">
      <label class="col-sm-2 control-label">{{Interactions}} :</label>
      <div class="col-sm-3">
        <select class="form-control eqLogicAttr configuration" data-l1key="configuration" data-l2key="user">
          <option value="0">{{Non}}</option>
          <option value="1">{{Oui}}</option>
        </select>
        </div>
      </div>

    </fieldset>
  </form>
  </div>

  <legend>{{Commandes}}</legend>
  <form class="form-horizontal">
            <fieldset>
                <div class="form-actions">
                    <a class="btn btn-danger eqLogicAction" data-action="remove"><i class="fa fa-minus-circle"></i> Supprimer</a>
                    <a class="btn btn-success eqLogicAction" data-action="save"><i class="fa fa-check-circle"></i> Sauvegarder</a>
                </div>
            </fieldset>
        </form>
<br>
  <table id="table_cmd" class="table table-bordered table-condensed">
    <thead>
      <tr>
        <th>{{Nom}}</th><th>{{Valeur}}</th><th>{{Options}}</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>

  <form class="form-horizontal">
    <fieldset>
      <div class="form-actions">
        <a class="btn btn-danger eqLogicAction" data-action="remove"><i class="fa fa-minus-circle"></i> {{Supprimer}}</a>
        <a class="btn btn-success eqLogicAction" data-action="save"><i class="fa fa-check-circle"></i> {{Sauvegarder}}</a>
      </div>
    </fieldset>
  </form>

  </div>
  </div>

<?php include_file('desktop', 'gammu', 'js', 'gammu'); ?>
<?php include_file('core', 'plugin.template', 'js'); ?>
