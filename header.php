<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header id="navbar">
        <div class="container">
            <div class="logo">
                <?php velixtech()->get_logo(); ?>
            </div>
            <div class="navbar">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Service</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
                <div class="navbar-last-item">
                    <button class="btn" @click="toggleMenu"><span class=" dashicons dashicons-menu-alt"></span></button>
                </div>
            </div>

        </div>
    </header>
