<?php
/**
 * @version     3.2.0
 * @package     com_secretary
 *
 * @author       Fjodor Schaefer (schefa.com)
 * @copyright    Copyright (C) 2015-2017 Fjodor Schaefer. All rights reserved.
 * @license      MIT License
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 * 
 */
 
// No direct access
defined('_JEXEC') or die;

$user       = Secretary\Joomla::getUser();
$business	= Secretary\Application::company('currency,taxvalue');
$currency	= $business['currency'];
$extension	= 'accountings';

$this->datafields		= \Secretary\Helpers\Items::makeFieldsReadyForList($this->item->fields);

if(!empty($this->item->accounting) && !is_array($this->item->accounting))
	$this->document->addScriptDeclaration('var accJSON = '.$this->item->accounting );

?>

<div class="secretary-main-container">
    
    <?php echo Secretary\HTML::_('datafields.item'); ?>
    
    <div class="secretary-acc-row clearfix" style="display:none;">
        <div class="secretary-acc-row-1"><div class="btn acc-row-remove"><i class="fa fa-remove"></i></div></div>
        <div class="secretary-acc-row-2">
            <input class="search-accounts form-control" type="text" value="##account##" placeholder="<?php echo JText::_('COM_SECRETARY_KONTO'); ?>" />
            <input name="jform[accounting][##type##][##counter##][id]" class="acc_##type##_konto" type="hidden" value="##accountid##" />
        </div>
        <div class="secretary-acc-row-3">
            <span><?php echo $currency; ?></span>
            <input name="jform[accounting][##type##][##counter##][sum]" class="form-control secretary-acc-total acc_##type##_sum" type="number" min="0" step="0.01" value="##sum##" />
        </div>
        
    </div>
    
    <form action="<?php echo JRoute::_('index.php?option=com_secretary&view=accounting&layout=edit&id='.(int)$this->item->id.'&extension='.$this->escape($this->extension)); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="adminForm" class="form-validate">
      
        
        <div class="secretary-main-area">
            
            <div class="secretary-toolbar fullwidth">
                <div class="secretary-title">
                <span><?php echo $this->title; ?>&nbsp;<i class="fa fa-angle-right"></i>&nbsp;</span>
                <?php $this->addToolbar(); ?>
                
                <div class="btn-toolbar pull-right">
                    <?php if($this->extension == 'accounting') { ?>
                    <div class="btn-group" style="width:50px;"><?php echo $this->form->getInput('year'); ?></div>
                    <?php } ?>
                </div>
                
                </div>
            </div>
            
            <fieldset>
                <?php  echo $this->loadTemplate($this->extension); ?>
            </fieldset>
            
        </div>
        
        <?php echo $this->form->getInput('id'); ?>
    
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="extension" value="<?php echo $this->extension; ?>" />
    <?php echo JHtml::_('form.token'); ?>
    </form>

    
<?php
$fields	= (isset($this->datafields['fields'])) ? $this->datafields['fields'] : '';
$javaScript = 'Secretary.printFields( ['. $fields .'] );';
$this->document->addScriptDeclaration($javaScript);
?>

</div>