<!-- this file should be at /views/templates/hook/cookiesbanner.tpl -->
<!-- Block cookiesbanner -->
<div id="cookiesbanner_block_home" class="block">
  <div class="block_content">
    <p>
           {if isset($cookies_banner_name) && $cookies_banner_name}
              {$cookies_banner_message}
              {$cookies_banner_more_info}
              <button id='btn'>{$cookies_banner_button}</button>
           {else}
              This site uses cookies!
           {/if}
    </p>
  </div>
</div>
<!-- /Block cookiesbanner -->
