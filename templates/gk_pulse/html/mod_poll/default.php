<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>

<form action="index.php" method="post" name="form2">
      <h5 class="polltitle"><?php echo $poll->title; ?></h5>
      <?php for ($i = 0, $n = count($options); $i < $n; $i ++) : ?>
      <p class="polllevel">
            <input type="radio" name="voteid" id="voteid<?php echo $options[$i]->id;?>" value="<?php echo $options[$i]->id;?>" alt="<?php echo $options[$i]->id;?>" />
            <label for="voteid<?php echo $options[$i]->id;?>">
                  <?php echo $options[$i]->text; ?>
            </label>
      </p>
      <?php endfor; ?>
      <div class="pollbuttons">
            <span>
            <input type="submit" name="task_button" class="button" value="<?php echo JText::_('Vote'); ?>" />
            </span>
            <span>
            <input type="button" name="option" class="button" value="<?php echo JText::_('Results'); ?>" onclick="document.location.href='<?php echo JRoute::_("index.php?option=com_poll&id=$poll->slug".$itemid); ?>'" />
            </span>
            <div class="clear"></div>
      </div>
      <input type="hidden" name="option" value="com_poll" />
      <input type="hidden" name="task" value="vote" />
      <input type="hidden" name="id" value="<?php echo $poll->id;?>" />
      <?php echo JHTML::_( 'form.token' ); ?>
</form>
