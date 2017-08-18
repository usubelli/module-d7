<?php
/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
global $base_root;
global $base_url;  
$current_url = $base_root . request_uri();

?>

<?php
	$url = $_SERVER['REQUEST_URI']; 
	$id_offre = explode('/', $url);	
	$id_offre =  $id_offre[2];
 

    $flux = simplexml_load_file("http://puissancecap.intuition-web.com");
    $index = 0;
    $offre = false;
    foreach ($flux->channel->item as $key => $valueID) {
        if ($valueID->reference == $id_offre) $offre = $index;
        if ($offre != false) break;
        // print '<pre>';
        //     var_dump($flux->channel->item[$offre]);
        // print '</pre>';

    $index++;
    }

    $offre = $flux->channel->item[$offre]; 
 
?>

<!-- POSTE -->
    <section id="poste">
        <div class="col-xs-12 col-sm-6 poste">
            <div class="left-side">
                <p class="size-2 bold color-light-purple margin-bottom-30 big-title"><?php print t('Poste'); ?></p>
                <h1 class="size-3 semi-bold color-light-purple margin-bottom-30"><?php print $offre->title; ?></h1>
                <h2><?php print $offre->contract_type; ?> - <?php print $offre->location; ?></h2>
                
                <?php print $offre->description; ?>
                              
                <a href="<?php print $base_url; ?>/nos-offres" class="size-6 bold color-pink link-arrow float-left margin-top-45"><?php print t('Retour à la liste des offres'); ?></a>    
                
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 candidature">
            <div class="right-side">
                <p class="size-3 semi-bold color-white margin-bottom-30"><?php print t('Postulez à cette offre'); ?></p>
                <div class="postuler"></div>
                <?php 
                    $block // = module_invoke('webform', 'block_view','client-block-15');
                    // print render($block['content'] );
                ?>  
            </div>
        </div>
    </section>
<!-- / POSTE -->


<script type="text/javascript">
    $(document).ready(function(){
         $('#edit-submitted-offre').val('<?php print $offre->title;?> - <?php print $offre->field_ville_offre['und'][0]['value'] ?> - <?php print $offre->field_type_de_contrat['und'][0]['value'] ?>');
    });
</script>