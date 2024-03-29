<?php echo get_component_slot('header'); ?>

<?php echo get_component('default', 'updateCheck'); ?>

<?php echo get_component('default', 'privacyMessage'); ?>

<?php if ($sf_user->isAdministrator() && '' === (string) QubitSetting::getByName('siteBaseUrl')) { ?>
  <div class="site-warning">
    <?php echo link_to(__('Please configure your site base URL'), 'settings/siteInformation', ['rel' => 'home', 'title' => __('Home')]); ?>
  </div>
<?php } ?>

<header>
  <div id="header-brand">
      <a id="header-logo" href="/">
        <?php echo image_tag('/plugins/arDemoThemePlugin/images/logo.png', ['width' => '20', 'height' => '20', 'alt' => __('UCA logo')]); ?>
      <div class="header-brand-text">
         <?php echo "<p class='up'>Universidad Centroamericana</p>" ?>
         <?php echo "<p class='down'>José Simeón Cañas</p>" ?>
      </div>
      </a>
      <?php echo "<hr id='vertical-hr'>"; ?>
      <div class="header-brand-text">
         <?php echo "<p class='up'>Archivo Histórico del Conflicto</p>" ?>
         <?php echo "<p class='down'>Armado Salvadoreño (Ahcas)</p>" ?>
      </div>

   </div>

  <div id="search-form-wrapper" role="search">

    <form action="<?php echo url_for(['module' => 'informationobject', 'action' => 'browse']); ?>" data-autocomplete="<?php echo url_for(['module' => 'search', 'action' => 'autocomplete']); ?>" autocomplete="off">

      <input type="hidden" name="topLod" value="0"/>
      <input type="hidden" name="sort" value="relevance"/>

      <?php if (isset($repository) && !sfConfig::get('app_enable_institutional_scoping')) { ?>
        <input type="text" name="query"<?php echo isset($sf_request->query) ? ' class="focused"' : ''; ?> aria-label="<?php echo __('Búsqueda %1%', ['%1%' => strip_markdown($repository)]); ?>" value="<?php echo $sf_request->query; ?>" placeholder="<?php echo __('Búsqueda %1%', ['%1%' => strip_markdown($repository)]); ?>"/>
      <?php } else { ?>
        <input type="text" name="query"<?php echo isset($sf_request->query) ? ' class="focused"' : ''; ?> aria-label="<?php echo __('%1%', ['%1%' => sfConfig::get('app_ui_label_globalSearch')]); ?>" value="<?php echo !$sf_user->getAttribute('search-realm') || !sfConfig::get('app_enable_institutional_scoping') ? $sf_request->query : ''; ?>" placeholder="<?php echo __('%1%', ['%1%' => sfConfig::get('app_ui_label_globalSearch')]); ?>"/>
      <?php } ?>

      <div id="search-realm" class="search-popover">

        <?php if (sfConfig::get('app_multi_repository')) { ?>

          <?php if (isset($repository)) { ?>
            <div>
              <label>
                <input name="repos" checked="checked" type="radio" value="<?php echo $repository->id; ?>" data-placeholder="<?php echo __('Search %1%', ['%1%' => strip_markdown($repository)]); ?>"/>
                <?php echo __('Búsqueda <span>%1%</span>', ['%1%' => render_title($repository)]); ?>
              </label>
            </div>
          <?php } ?>

          <?php if (isset($altRepository)) { ?>
            <div>
              <label>
                <input name="repos" type="radio" value="<?php echo $altRepository->id; ?>" data-placeholder="<?php echo __('Search %1%', ['%1%' => strip_markdown($altRepository)]); ?>"/>
                <?php echo __('Búsqueda <span>%1%</span>', ['%1%' => render_title($altRepository)]); ?>
              </label>
            </div>
          <?php } ?>

        <?php } ?>

        <div class="search-realm-advanced">
          <a href="<?php echo url_for(['module' => 'informationobject', 'action' => 'browse', 'showAdvanced' => true, 'topLod' => false]); ?>">
            <?php echo __('Búsqueda Avanzada'); ?>&nbsp;&raquo;
          </a>
        </div>

      </div>

    </form>

    <div id="browse-menu">

  <button class="top-item top-dropdown" data-toggle="dropdown" data-toggle="dropdown" target="#" aria-expanded="false"><?php echo image_tag('/plugins/arDemoThemePlugin/images/arrow.svg'); ?></button>

  <div class="top-dropdown-container top-dropdown-container-right">

    <div class="top-dropdown-arrow">
      <div class="arrow"></div>
    </div>

    <div class="top-dropdown-body">
      <ul>
        <li id="node_browseInformationObjects" class="leaf">
          <a href="/index.php/informationobject/browse" title="Archival Descriptions">
            <?php echo image_tag('/plugins/arDemoThemePlugin/images/menu.svg'); ?>
            Descripción archivística
          </a>
        </li>
        <li id="node_browseActors" class="leaf">
          <a href="/index.php/actor/browse" title="Authority Records">
            <?php echo image_tag('/plugins/arDemoThemePlugin/images/person.svg'); ?>
            Registros de autoridad
          </a>
        </li>
        <li id="node_browseRepositories" class="leaf">
          <a href="/index.php/repository/browse" title="Archival Institutions">
            <?php echo image_tag('/plugins/arDemoThemePlugin/images/domain.svg'); ?>
            Instituciones
          </a>
        </li>
        <li id="node_browseSubjects" class="leaf">
          <a href="/index.php/taxonomy/index/id/35" title="Subjects">
            <?php echo image_tag('/plugins/arDemoThemePlugin/images/subject.svg'); ?>
            Materias
         </a>
        </li>
        <li id="node_browsePlaces" class="leaf">
          <a href="/index.php/taxonomy/index/id/42" title="Places">
            <?php echo image_tag('/plugins/arDemoThemePlugin/images/location.svg'); ?>
            Lugares
          </a>
        </li>
        <li id="node_browseDigitalObjects" class="leaf">
          <a href="/index.php/informationobject/browse?view=card&onlyMedia=1&topLod=0" title="Digital Objects">
            <?php echo image_tag('/plugins/arDemoThemePlugin/images/computer.svg'); ?>
            Objetos digitales
          </a>
        </li>
      </ul>
    </div>

    <div class="top-dropdown-bottom"></div>

  </div>

</div>

  </div>

  <nav>
    <?php echo get_component('menu', 'userMenu'); ?>
    <?php echo get_component('menu', 'mainMenu', ['sf_cache_key' => $sf_user->getCulture().$sf_user->getUserID()]); ?>
  </nav>

</header>
