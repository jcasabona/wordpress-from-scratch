<?php

/** Create the Custom Post Type**/
add_action('init', 'business_manager_register');  
  
 
function business_manager_register() {  
    
    //Arguments to create post type.
    $args = array(  
        'label' => __('Business Manager'),  
        'singular_label' => __('Business'),  
        'public' => true,  
        'show_ui' => true,  
        'capability_type' => 'post',  
        'hierarchical' => true,  
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'rewrite' => array('slug' => 'businesses', 'with_front' => false),
       );  
  
  	//Register type and custom taxonomy for type.
    register_post_type( 'businesses' , $args );  
    register_taxonomy("business-type", array("businesses"), array("hierarchical" => true, "label" => "Business Types", "singular_label" => "Business Type", "rewrite" => true, "slug" => 'business-type')); 
}  
 

/*Adds Support for Featured Images**/
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size( 220, 150 );
    add_image_size('storefront', 620, 270, true);
}

add_action("admin_init", "business_manager_add_meta");  
  

function business_manager_add_meta(){  
    add_meta_box("business-meta", "Business Options", "business_manager_meta_options", "businesses", "normal", "high");   
}  
  

//Create area for extra fields
function business_manager_meta_options(){  
        global $post;  
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
        
        $custom = get_post_custom($post->ID);
		$address= $custom["address"][0];
		$address_two= $custom["address_two"][0];
		$city= $custom["city"][0];
		$state= $custom["state"][0];
		$zip= $custom["zip"][0];
        $website = $custom["website"][0]; 
        $phone = $custom["phone"][0]; 
        $email = $custom["email"][0]; 
?>  

<style type="text/css">
<?php include('business-manager.css'); ?>
</style>

<div class="business_manager_extras">

<?php	
		
	$website= ($website == "") ? "http://" : $website;
?>
	<div><label>Website:</label><input name="website" value="<?php echo $website; ?>" /></div>
	<div><label>Phone:</label><input name="phone" value="<?php echo $phone; ?>" /></div>
	<div><label>Email:</label><input name="email" value="<?php echo $email; ?>" /></div>
	<div><label>Address:</label><input name="address" value="<?php echo $address; ?>" /></div>
	<div><label>Address 2:</label><input name="address_two" value="<?php echo $address_two; ?>" /></div>
	<div><label>City:</label><input name="city" value="<?php echo $city; ?>" /></div>
	<div><label>State:</label><input name="state" value="<?php echo $state; ?>" /></div>
	<div><label>Zip:</label><input name="zip" value="<?php echo $zip; ?>" /></div>
</div>   
<?php  
    } 
    
add_action('save_post', 'business_manager_save_extras'); 
  
function business_manager_save_extras(){  
    global $post;  
    
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){ //if you remove this the sky will fall on your head.
		return $post_id;
	}else{
    	update_post_meta($post->ID, "website", $_POST["website"]); 
    	update_post_meta($post->ID, "city", $_POST["city"]);
    	update_post_meta($post->ID, "state", $_POST["state"]);
    	update_post_meta($post->ID, "address", $_POST["address"]);
    	update_post_meta($post->ID, "address_two", $_POST["address_two"]); 
    	update_post_meta($post->ID, "zip", $_POST["zip"]);
    	update_post_meta($post->ID, "phone", $_POST["phone"]);
    	update_post_meta($post->ID, "email", $_POST["email"]);
    } 
}  

add_filter("manage_edit-businesses_columns", "business_manager_edit_columns");   

function business_manager_edit_columns($columns){
        $columns = array(
            "cb" => "<input type=\"checkbox\" />",
            "title" => "Business Name",
            "description" => "Description",
            "address" => "Address", 
            "phone" => "Phone",
            "email" => "Email",
            "website" => "Website",
            "cat" => "Category",
        );  

        return $columns;
}  

add_action("manage_businesses_posts_custom_column",  "business_manager_custom_columns"); 

function business_manager_custom_columns($column){
        global $post;
        $custom = get_post_custom();
        switch ($column)
        {
                        
            case "description":
                the_excerpt();
                break;
            case "address":
            	$address= $custom["address"][0].'<br/>';
            	if($custom["address_two"][0] != "") $address.= $custom["address_two"][0].'<br/>';
            	$address.= $custom["city"][0].', '.$custom["state"][0].' '.$custom["zip"][0];
            	
            	echo $address;
            	break;
            case "phone":
            	echo $custom["phone"][0];
            	break;
            case "email":
            	echo $custom["email"][0];
            	break;
            case "website":
                echo $custom["website"][0];
                break;
            case "cat":
                echo get_the_term_list($post->ID, 'business-type', '', ', ','');
                break;
        }
}  




?>