<?php
//custom field for user
add_action( 'show_user_profile', 'cryptcio_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'cryptcio_show_extra_profile_fields' );
function cryptcio_show_extra_profile_fields( $user ) { ?>
    <h3><?php echo esc_html__( 'Extra profile information', 'cryptcio' );?></h3>
    <table class="form-table">
        <tr>
            <th><label for="facebook"><?php echo esc_html__( 'Facebook', 'cryptcio' );?></label></th>

            <td>
                <input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php echo esc_html__( 'Please enter your facebook link.', 'cryptcio' );?></span>
            </td>
        </tr>
        <tr>
            <th><label for="google"><?php echo esc_html__( 'Google', 'cryptcio' );?></label></th>

            <td>
                <input type="text" name="google" id="google" value="<?php echo esc_attr( get_the_author_meta( 'google', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php echo esc_html__( 'Please enter your google link.', 'cryptcio' );?></span>
            </td>
        </tr>
        <tr>
            <th><label for="instagram"><?php echo esc_html__( 'Instagram', 'cryptcio' );?></label></th>

            <td>
                <input type="text" name="instagram" id="instagram" value="<?php echo esc_attr( get_the_author_meta( 'instagram', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php echo esc_html__( 'Please enter your instagram link.', 'cryptcio' );?></span>
            </td>
        </tr>
        <tr>
            <th><label for="twitter"><?php echo esc_html__( 'Twitter', 'cryptcio' );?></label></th>

            <td>
                <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php echo esc_html__( 'Please enter your twitter link.', 'cryptcio' );?></span>
            </td>
        </tr>
        <tr>
            <th><label for="avatar"><?php echo esc_html__('User Avatar (square image recommended)','cryptcio');?></label></th>

            <td>
                <input type="text" name="avatar" id="avatar" value="<?php echo esc_attr( get_the_author_meta( 'avatar', $user->ID ) ); ?>" class="regular-text" /> 
                <input class="button_upload_image button" id="avatar" type="button" value="<?php echo esc_html__('Upload Image', 'cryptcio') ?>" />&nbsp;
                <input class="button_remove_image button" id="avatar" type="button" value="<?php echo esc_html__('Remove Image', 'cryptcio') ?>" />
                <br />                         
                <div class="user_ava_field">
                <?php if(get_the_author_meta( 'avatar', $user->ID ) !=''):?>
                    <img width="100" alt="" src="<?php echo esc_url( get_the_author_meta( 'avatar', $user->ID ) ); ?>">
                <?php endif;?>
                </div>
                               
            </td>
        </tr>                
    </table>
<?php }
add_action( 'personal_options_update', 'cryptcio_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'cryptcio_save_extra_profile_fields' );

function cryptcio_save_extra_profile_fields( $user_id ) {

    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
    update_user_meta( $user_id, 'google', $_POST['google'] );
    update_user_meta( $user_id, 'instagram', $_POST['instagram'] );
    update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
    update_user_meta( $user_id, 'avatar', $_POST['avatar'] );    
}
// Apply filter
add_filter( 'get_avatar' , 'cryptcio_custom_avatar' , 1 , 5 );

function cryptcio_custom_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
    $user = false;
    if ( is_numeric( $id_or_email ) ) {

        $id = (int) $id_or_email;
        $user = get_user_by( 'id' , $id );

    } elseif ( is_object( $id_or_email ) ) {

        if ( ! empty( $id_or_email->user_id ) ) {
            $id = (int) $id_or_email->user_id;
            $user = get_user_by( 'id' , $id );
        }

    } else {
        $user = get_user_by( 'email', $id_or_email );   
    }

    if ( $user && is_object( $user ) ) {

        if(get_the_author_meta('avatar') !=''){
            $avatar = get_the_author_meta('avatar');
            $avatar = "<img alt='{$alt}' src='{$avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
        }

    }
    

    return $avatar;
}
function cryptcio_author_box() {  ?>
    <?php if(get_the_author_meta( 'description' ) != ''):?>
        <div class="author_blog">
            <div class="avatar_author">
                <?php echo get_avatar( get_the_author_meta( 'user_email' ), '101' ); ?> 
            </div>
            <div class="desc_author">
                <div class="author_info">
                    <div class="name_author">
                        <?php the_author(); ?>
                    </div>              
                </div>
                <p><?php the_author_meta( 'description' ); ?></p>
                <div class="social-user">
                    <?php if ( get_the_author_meta( 'facebook' ) ) : ?>
                        <div class="link_author">
                            <a target="_blank" href="<?php the_author_meta( 'facebook' );?>"><i class="fa fa-facebook"></i></a>
                        </div>
                    <?php endif;?>   
                    <?php if ( get_the_author_meta( 'google' ) ) : ?>
                        <div class="link_author">
                            <a target="_blank" href="<?php the_author_meta( 'google' );?>"><i class="fa fa-google"></i></a>
                        </div>
                    <?php endif;?>   
                    <?php if ( get_the_author_meta( 'instagram' ) ) : ?>
                        <div class="link_author">
                            <a target="_blank" href="<?php the_author_meta( 'instagram' );?>"><i class="fa fa-instagram"></i></a>
                        </div>
                    <?php endif;?>   
                    <?php if ( get_the_author_meta( 'twitter' ) ) : ?>
                        <div class="link_author">
                            <a target="_blank" href="<?php the_author_meta( 'twitter' );?>"><i class="fa fa-twitter"></i></a>
                        </div>
                    <?php endif;?>   
                </div>
            </div>
        </div>
    <?php endif;?>
    <?php
}