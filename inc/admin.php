<?php

if (!defined( 'ABSPATH')) {
	exit; // Exit if accessed directly.
}
 
 /* Add the Kayako options page to the Admin Menu */
function kayako_admin_menu() {
    
    add_menu_page('Kayako Messenger', 'Kayako Messenger', 'manage_options', 'kayako_admin_page', 'kayako_admin_page', '', '80.1');
    
}
add_action('admin_menu', 'kayako_admin_menu');

/* Kayako Admin Page */
function kayako_admin_page() {
    
    // Get/Set Options
    $embed_code = get_option('_kayako_embed_code');
    if ( empty($embed_code) ) {
        add_option('_kayako_embed_code');
    }
    
    $token = get_option('_kayako_token');
    if ( empty($token) ) {
        add_option('_kayako_token');
    }
    
    $track = get_option('_kayako_user_init');
    if ( empty($token) ) {
        add_option('_kayako_user_init', 0);
    }
    
    // Form Handler
    if ( !empty($_POST['kayako_embed_code']) ) {
        update_option('_kayako_embed_code', json_encode(stripslashes($_POST['kayako_embed_code'])), '', 'yes' );
    }
    
    if ( !empty($_POST['kayako_token']) ) {
        update_option('_kayako_token', stripslashes($_POST['kayako_token']), '', 'yes' );
    }
    
    if( $_POST ) { 
        if ( isset($_POST['kayako_user_init']) == 1 ) {
            update_option('_kayako_user_init', 1, '', 'yes' );
        } else {
            update_option('_kayako_user_init', 0, '', 'yes' );
        }
    }
    
    // Display
    if ( $_POST ) {
        $success = true;
    }
    
    $checked = ( get_option('_kayako_user_init') == 1 ? "checked" : '' );

?>
<style>
    #kayako div {
        padding: 16px;
    }
    #kayako fieldset {
        border:1px solid #000; 
        width:90%; 
        margin-top:20px; 
        padding:10px;
    }
    #kayako legend {
        font-size:16px; 
        font-weight:700;
    }
    #kayako label {
        display: block;
        padding: 2px 0;
    }
    #row-3 {
        display: none;
    }
</style>
<div id="kayako">
    <h3>Kayako Messenger Embed</h3>
    <form method="post" action="">
        <fieldset>
            <legend>Settings</legend>
                <div id="row-1">
                    <label>Embed Code:</label><br>
                    <textarea id="kayako_embed_code" name="kayako_embed_code" cols="89" rows="14"><?php echo json_decode(get_option('_kayako_embed_code')); ?></textarea>
                    <p>Enter your Kayako Messenger embed code. You can find this in your Kayako admin section. <a href="https://support.kayako.com/article/1171" target="_blank">Find out more</a>.</p>
                </div>
                <div id="row-2"><input type="checkbox" id="kayako_user_init" name="kayako_user_init" value="1" <?php echo $checked;?>> Enable identity verification. <a href="https://support.kayako.com/article/1399" target="_blank">Find out more</a>.
                </div>
                <div id="row-3">
                    <label>Token: <span style="color: red;">*</span></label><br>
                    <input type="text" id="kayako_token" name="kayako_token" value="<?php echo get_option('_kayako_token'); ?>" size="82" required>
                </div>
                <div id="row-4">
                     <input type="submit" id="kayako_sub" name="kayako_sub" value="Save"/> 
                </div>
                <?php if ( isset($success) && $success == true ) {?>
                <div id="message">
                    <p><span style="color: green;">Settings saved. Visit <a href="<?php echo get_home_url(); ?>">your site</a> to see Kayako Messenger in action.</span></p>
                </div>
                <?php }?>
        </fieldset>
        <fieldset>
            <legend>Support</legend>
            <div>Need help? Visit the <a href="https://support.kayako.com" target="_blank">Kayako Help Center</a> for support.</div>
        </fieldset>
    </form>
</div>
<script>
jQuery(document).ready(function( $ ) {
    if($('#kayako_user_init').is(':checked')){
        $('#row-3').show();
        $('#kayako_token').prop('required',true);
    }else{
        $('#row-3').hide();
        $('#kayako_token').prop('required',false);
    }
    $('#kayako_user_init').click(function(){
        if($(this).is(":checked")){
            $('#row-3').show();
            $('#kayako_token').prop('required',true);
        }else{
            $('#row-3').hide();
            $('#kayako_token').prop('required',false);
        }
    });
});
</script>
<?php

}