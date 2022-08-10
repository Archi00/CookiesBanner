{if !$cookies_banner_cookies_accepted}
  <!-- this file should be at /views/templates/hook/cookiesbanner.tpl -->
  <!-- Block cookiesbanner -->
  <div id="cookiesbanner_block_home" class="block">
    <div class="block_content">
      <div class="block_container_flex">
        <p>
              {if isset($cookies_banner_name) && $cookies_banner_name}
                  {$cookies_banner_message_main}
                  {$cookies_banner_message_sub}
              {else}
                  This site uses cookies!
              {/if}
        </p>
        <button id="cookiesbanner_accept_btn">{$cookies_banner_button}</button>
      </div>
    </div>
  </div>
{/if}
<!-- /Block cookiesbanner -->
