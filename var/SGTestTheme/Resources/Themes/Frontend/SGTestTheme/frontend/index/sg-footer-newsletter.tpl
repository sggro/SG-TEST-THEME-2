<div class="sg-footer-newsletter">
    <div class="sg-footer-newsletter-wrapper">
    <div class="sg-footer-newsletter-header">
        {s namespace="frontend/index/menu_footer" name="sFooterNewsletterHead"}{/s}
    </div>
    <div class="sg-footer-newsletter-description">
        {s namespace="frontend/index/menu_footer" name="sFooterNewsletter"}{/s}
    </div>
    <div class="sg-footer-newsletter-form">
        {block name="frontend_index_footer_column_newsletter_form"}
            <form class="newsletter--form" action="{url controller='newsletter'}" method="post">
                <input type="hidden" value="1" name="subscribeToNewsletter" />

                {block name="frontend_index_footer_column_newsletter_form_field_wrapper"}
                    <div class="content">
                        {block name="frontend_index_footer_column_newsletter_form_field"}
                            <input type="email" aria-label="{s namespace="frontend/index/menu_footer" name="IndexFooterNewsletterValue"}{/s}" name="newsletter" class="newsletter--field"/>
                            {if {config name="newsletterCaptcha"} !== "nocaptcha"}
                                <input type="hidden" name="redirect">
                            {/if}
                        {/block}

                        {block name="frontend_index_footer_column_newsletter_form_submit"}
                            <button type="submit" aria-label="{s namespace="frontend/index/menu_footer" name='IndexFooterNewsletterSubmit'}{/s}" class="newsletter--button btn">
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            </button>
                        {/block}
                    </div>
                {/block}

                {* Data protection information *}{*
                {block name="frontend_index_footer_column_newsletter_privacy"}
                    {if {config name=ACTDPRTEXT} || {config name=ACTDPRCHECK}}
                        {$hideCheckbox=false}

                        *}{* If a captcha is active, the user has to accept the privacy statement on the newsletter page *}{*
                        {if {config name=newsletterCaptcha} !== "nocaptcha"}
                            {$hideCheckbox=true}
                        {/if}

                        {include file="frontend/_includes/privacy.tpl" hideCheckbox=$hideCheckbox}
                    {/if}
                {/block}*}
            </form>
        {/block}
    </div>
    </div>
</div>