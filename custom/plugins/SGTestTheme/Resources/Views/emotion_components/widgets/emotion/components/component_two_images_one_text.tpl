{block name="widgets_emotion_components_two_images_one_text_element"}
    <div class="sg-test-theme-tiot-ewe">
        <div class="container">
            <div class="sg-test-theme-tiot-titel">{$Data.titel}</div>
            <div class="sg-test-theme-tiot-left-image">
                <img src="{$Data.left_image}" />
            </div>
            <div class="sg-test-theme-tiot-right-image">
                <img src="{$Data.right_image}" />
            </div>
            <div class="sg-test-theme-tiot-description-wrapper">
                <div class="sg-test-theme-tiot-description-titel">{$Data.descriptionTitel}</div>
                <div class="sg-test-theme-tiot-description">{$Data.description}</div>
                <div class="sg-test-theme-tiot-links-wrapper">
                    <div class="sg-test-theme-tiot-link-wrapper sg-test-theme-tiot-read-more-wrapper">
                        <a href="{$Data.readMoreLink}" target="_blank">
                            <div class="sg-test-theme-tiot-link-icon">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </div>
                            Mehr lesen
                        </a>
                    </div>
                    <div class="sg-test-theme-tiot-link-wrapper sg-test-theme-tiot-go-shopping-wrapper">
                        <a href="{$Data.goShoppingLink}" target="_blank">
                            <div class="sg-test-theme-tiot-link-icon">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </div>
                            Jetzt Shoppen
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}