<!-- this file should be at /views/templates/hook/cookiesbanner.tpl -->
<!-- Block cookiesbanner -->
<div id="cookiesbanner_block_home" class="block">
  <h4>{l s='Welcome!' mod='cookiesbanner'}</h4>
  <div class="block_content">
    <p>Hello,
           {if isset($cookies_banner_name) && $cookies_banner_name}
               {$cookies_banner_name}
           {else}
               World
           {/if}
           !
    </p>
  </div>
</div>
<!-- /Block cookiesbanner -->
