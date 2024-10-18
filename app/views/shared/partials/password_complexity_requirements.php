<div>
    <h4>Password Requirements</h4>
    <ul class="pl-3">
        <?php if(SET_PW_MIN_LENGTH == "true"):?>
            <li>Minimum <?= PW_MIN_LENGTH ?> characters in length</li>
        <?php endif; ?>

        <?php if(SET_PW_MAX_LENGTH == "true"):?>
            <li>Maximum of <?= PW_MIN_LENGTH ?> characters in length</li>
        <?php endif; ?>

        <?php if(PW_UPPER_CHAR == "true"):?>
            <li>At least 1 upper case character</li>
        <?php endif; ?>

        <?php if(PW_LOWER_CHAR == "true"):?>
            <li>At least 1 lower case character</li>
        <?php endif; ?>

        <?php if(PW_NUM_CHAR == "true"):?>
            <li>At least 1 number</li>
        <?php endif; ?>

        <?php if(PW_SPECIAL_CHAR == "true"):?>
            <li>Must contain at least 1 special character</li>
        <?php endif; ?>  
        <li>Must not contain any spaces</li>
    </ul>
</div>