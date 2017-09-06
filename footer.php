<?php
/**
 * File Description : The template display footer. And close up div from eithe header or body pages. 
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @version     1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Dependant : framework/hooks/actions (for all hooks to footer). 
 *             partials/footer (for display modification).
 */ 
?>

            <?php athen_hook_main_bottom(); ?>

        </div><!-- #main-content --><?php // main-content opens in header.php ?>
                
        <?php athen_hook_main_after(); ?>

        <?php athen_hook_wrap_bottom(); ?>

    </div><!-- #athen-alt-capsule -->

    <?php athen_hook_wrap_after(); ?>

</div><!-- #athen-main-capsule -->

<?php athen_outer_wrap_after(); ?>

<?php wp_footer(); ?>

</body>
</html>