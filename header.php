<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header id="navbar" v-cloak>
        <div class="primary-header">
            <div class="container">
                <div class="logo">
                    <?php velixtech()->get_logo(); ?>
                </div>
                <div class="navbar">

                    <?php velixtech()->primary_menu(); ?>


                    <?php echo get_option('admin_bar_front'); ?>


                    <div class="navbar-last-item d-lg-none">
                        <button class="toggle" @click="openMenu">
                            <template v-if="!toggle">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                                    <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                                </svg>
                            </template>
                            <template v-else>
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                                    <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                                </svg>
                            </template>

                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-space"></div>
        <div class="m-menu" v-if="toggle">
            <div class="overlay" :class="{'show' : fade}" @click="closeMenu"></div>
            <div class="mobile-menu-parent" :class="{'show' : fade}">
                <div class="d-flex align-items-center justify-content-between <?php echo is_admin_bar_showing() ? 'active-admin-bar' : ''; ?>">
                    <?php velixtech()->get_logo(); ?>
                    <span>
                        <button class="toggle offcanvas" @click="closeMenu">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                                <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                            </svg>
                        </button>
                    </span>
                </div>

                <?php velixtech()->offcanvas_menu(); ?>
            </div>

        </div>

    </header>
