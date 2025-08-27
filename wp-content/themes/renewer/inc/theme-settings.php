<?php

require_once get_theme_file_path() . '/inc/codestar-framework-master/codestar-framework.php';



// Control core classes for avoid errors

if (class_exists('CSF')) {



	//

	// Set a unique slug-like ID

	$prefix = 'Renewer';



	//

	// Create options

	CSF::createOptions($prefix, array(

		'menu_title' => 'Tema Ayarları',

		'menu_slug'  => 'tema-ayarlari',

		'framework_title' => 'Tema Ayarları',

		'theme' => 'light'

	));



	CSF::createSection($prefix, array(

		'title' => 'Genel Ayarlar',

		'fields' => array(

			array(

				'id'      => 'loading',

				'type'    => 'media',

				'title'   => 'Yükleme Animasyonu',

				'library' => 'image',

			),

			array(

				'id'      => 'logo',

				'type'    => 'media',

				'title'   => 'Logo',

				'library' => 'image',

			),

			array(

				'id'      => 'mobile-logo',

				'type'    => 'media',

				'title'   => 'Mobil Logo',

				'library' => 'image',

			),

			array(

				'id'      => 'footer-logo',

				'type'    => 'media',

				'title'   => 'Footer Logo',

				'library' => 'image',

			),

			array(

				'id'      => 'favixon',

				'type'    => 'media',

				'title'   => 'Favicon',

				'library' => 'image',

			),



		)

	));

	CSF::createSection($prefix, array(

		'title' => 'Sosyal Medya Ayarları',

		'fields' => array(

			array(

				'id'      => 'facebook',

				'type'    => 'text',

				'title'   => 'Facebook Adresi Giriniz',

			),

			array(

				'id'      => 'instagram',

				'type'    => 'text',

				'title'   => 'İnstagram Adresi Giriniz',

			),

			array(

				'id'      => 'whatsapp',

				'type'    => 'text',

				'title'   => 'Whatsapp Adresi Giriniz',

			),

			array(

				'id'      => 'linkedin',

				'type'    => 'text',

				'title'   => 'Linkedin Adresi Giriniz',

			),

			array(

				'id'      => 'youtube',

				'type'    => 'text',

				'title'   => 'Youtube Adresi Giriniz',

			),

			array(

				'id'      => 'whatsaap',

				'type'    => 'text',

				'title'   => 'Whatsaap Numarası Giriniz',

			),



		)

	));


	CSF::createSection($prefix, array(
		'title'  => 'İletişim Ayarları',
		'fields' => array(
			array(
				'id'    => 'sabit-telefon',
				'type'  => 'text',
				'title' => 'Sabit Telefon Numarası Giriniz',
			),
			array(
				'id'    => 'gsm-telefon',
				'type'  => 'text',
				'title' => 'Gsm Telefon Numarası Giriniz',
			),
			array(
				'id'    => 'e-posta',
				'type'  => 'text',
				'title' => 'Mail Adresi Giriniz',
			),
			array(
				'id'    => 'adres',
				'type'  => 'text',
				'title' => 'İletişim Adresi Giriniz',
			),
			array(
				'id'    => 'harita',
				'type'  => 'text',
				'title' => 'Google Harita',
			),
			array(
				'id'    => 'background-image',
				'type'  => 'media',
				'title' => 'Arka Plan Görseli Seçiniz',
				'library' => 'image',
			),
		)
	));



	CSF::createSection($prefix, array(

		'title' => 'Yönlendirme Ayarları',

		'fields' => array(

			array(

				'id'      => 'kvkk',

				'type'    => 'text',

				'title'   => 'Kvkk Politikası Linki',

			),

			array(

				'id'      => 'cerez',

				'type'    => 'text',

				'title'   => 'Cerez Politikası Linki',

			),

			array(

				'id'      => 'galeri',

				'type'    => 'text',

				'title'   => 'Galeri Button Linki',

			),

			array(

				'id'      => 'kurumsal',

				'type'    => 'text',

				'title'   => 'Hakkımızda Button Linki',

			),



		)

	));


	CSF::createSection($prefix, array(

		'title' => 'Sabit Metinler Ayarları',

		'fields' => array(


			array(

				'id'      => 'hakkimizda-img',

				'type'    => 'media',

				'title'   => 'Hakkımızda Resmi',

			),

			array(

				'id'      => 'hakkimizda-title',

				'type'    => 'text',

				'title'   => 'Hakkımızda Başlık',

			),

			array(

				'id'      => 'hakkimizda-description',

				'type'    => 'wp_editor',

				'title'   => 'Hakkımızda Açıklama ',

			),
			array(

				'id'      => 'footer-description',

				'type'    => 'wp_editor',

				'title'   => 'Footer Açıklama ',

			),
			array(

				'id'      => 'copyright',

				'type'    => 'text',

				'title'   => 'copyright ',

			),

		)

	));



	CSF::createSection($prefix, array(

		'title' => 'Hizmetlerimiz Kategori Ayarları',

		'fields' => array(

			array(

				'id'      => 'hizmetler-description',

				'type'    => 'wp_editor',

				'title'   => 'Hizmetler Açıklama',

			),

		)

	));


	CSF::createSection($prefix, array(

		'title' => 'Ana Sayfa Galeri Ayarları',

		'fields' => array(

			array(

				'id'      => 'galeri_img_1',

				'type'    => 'media',

				'title'   => 'Galeri Resmi 1',

			),

			array(

				'id'      => 'galeri_img_2',

				'type'    => 'media',

				'title'   => 'Galeri Resmi 2',

			),

			array(

				'id'      => 'galeri_img_3',

				'type'    => 'media',

				'title'   => 'Galeri Resmi 3',

			),

			array(

				'id'      => 'galeri_img_4',

				'type'    => 'media',

				'title'   => 'Galeri Resmi 4',

			),

			array(

				'id'      => 'galeri_img_5',

				'type'    => 'media',

				'title'   => 'Galeri Resmi 5',

			),

		)

	));






	CSF::createSection($prefix, array(

		'title'  => 'Yedekleme',

		'fields' => array(

			array(

				'type' => 'backup',

			),

		)

	));
}
