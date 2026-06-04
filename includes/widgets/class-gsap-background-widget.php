<?php
/**
 * GSAP Background Elementor widget.
 *
 * @package GsapBackground
 */

namespace GsapBackground\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Elementor widget for the animated GSAP background section.
 */
class Gsap_Background_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'gsap_background';
	}

	/**
	 * Get widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'GSAP Background', 'gsap-background' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-animation';
	}

	/**
	 * Get widget categories.
	 *
	 * @return array
	 */
	public function get_categories() {
		return array( 'general' );
	}

	/**
	 * Get style dependencies.
	 *
	 * @return array
	 */
	public function get_style_depends() {
		return array( 'gsap-background-widget' );
	}

	/**
	 * Get script dependencies.
	 *
	 * @return array
	 */
	public function get_script_depends() {
		return array( 'gsap-background-widget' );
	}

	/**
	 * Register controls.
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'gsap-background' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'hero_image',
			array(
				'label'   => esc_html__( 'Hero Image', 'gsap-background' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => GSAP_BACKGROUND_URL . 'images/background.jpg',
				),
			)
		);

		$this->add_control(
			'hero_image_alt',
			array(
				'label'   => esc_html__( 'Hero Image Alt Text', 'gsap-background' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'hero', 'gsap-background' ),
			)
		);

		$this->add_control(
			'title_line_1',
			array(
				'label'   => esc_html__( 'Heading Line 1', 'gsap-background' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'ALPINE', 'gsap-background' ),
			)
		);

		$this->add_control(
			'title_line_2',
			array(
				'label'   => esc_html__( 'Heading Line 2', 'gsap-background' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'ESCAPE', 'gsap-background' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'stars_section',
			array(
				'label' => esc_html__( 'Symbols', 'gsap-background' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_stars',
			array(
				'label'        => esc_html__( 'Show Symbols', 'gsap-background' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'gsap-background' ),
				'label_off'    => esc_html__( 'Hide', 'gsap-background' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$star_repeater = new Repeater();

		$star_repeater->add_control(
			'symbol',
			array(
				'label'   => esc_html__( 'Symbol', 'gsap-background' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '*',
			)
		);

		$star_repeater->add_control(
			'color',
			array(
				'label'   => esc_html__( 'Color', 'gsap-background' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#ff1a8c',
			)
		);

		$star_repeater->add_control(
			'size',
			array(
				'label'      => esc_html__( 'Size', 'gsap-background' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'rem' ),
				'range'      => array(
					'px'  => array(
						'min' => 10,
						'max' => 120,
					),
					'rem' => array(
						'min'  => 0.5,
						'max'  => 8,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 34,
				),
			)
		);

		$star_repeater->add_control(
			'position',
			array(
				'label'       => esc_html__( 'CSS Position', 'gsap-background' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'top:25%;left:28%;',
				'description' => esc_html__( 'Use top/left/right/bottom values, for example: top:25%;left:28%;', 'gsap-background' ),
			)
		);

		$this->add_control(
			'stars',
			array(
				'label'       => esc_html__( 'Symbols', 'gsap-background' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $star_repeater->get_controls(),
				'title_field' => '{{{ symbol }}}',
				'condition'   => array(
					'show_stars' => 'yes',
				),
				'default'     => array(
					array(
						'symbol'   => '*',
						'color'    => '#ff1a8c',
						'size'     => array(
							'unit' => 'px',
							'size' => 40,
						),
						'position' => 'top:25%;left:28%;',
					),
					array(
						'symbol'   => '+',
						'color'    => '#0e0d0c',
						'size'     => array(
							'unit' => 'px',
							'size' => 30,
						),
						'position' => 'top:60%;left:10%;',
					),
					array(
						'symbol'   => '*',
						'color'    => '#ff661a',
						'size'     => array(
							'unit' => 'px',
							'size' => 48,
						),
						'position' => 'top:30%;right:25%;',
					),
					array(
						'symbol'   => '+',
						'color'    => '#0affee',
						'size'     => array(
							'unit' => 'px',
							'size' => 36,
						),
						'position' => 'bottom:28%;left:22%;',
					),
					array(
						'symbol'   => '*',
						'color'    => '#fff200',
						'size'     => array(
							'unit' => 'px',
							'size' => 24,
						),
						'position' => 'top:16%;left:15%;',
					),
					array(
						'symbol'   => '+',
						'color'    => '#ff1a8c',
						'size'     => array(
							'unit' => 'px',
							'size' => 56,
						),
						'position' => 'bottom:18%;right:18%;',
					),
					array(
						'symbol'   => '*',
						'color'    => '#0e0d0c',
						'size'     => array(
							'unit' => 'px',
							'size' => 22,
						),
						'position' => 'top:48%;right:9%;',
					),
					array(
						'symbol'   => '+',
						'color'    => '#0affee',
						'size'     => array(
							'unit' => 'px',
							'size' => 28,
						),
						'position' => 'bottom:36%;left:6%;',
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			array(
				'label' => esc_html__( 'Style', 'gsap-background' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'background_gradient_heading',
			array(
				'label' => esc_html__( 'Background Gradient', 'gsap-background' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'enable_gradient_overlay',
			array(
				'label'        => esc_html__( 'Show Gradient Overlay', 'gsap-background' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'gsap-background' ),
				'label_off'    => esc_html__( 'Hide', 'gsap-background' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'gradient_pink',
			array(
				'label'     => esc_html__( 'Pink Glow', 'gsap-background' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'hsl(330, 100%, 55%)',
				'selectors' => array(
					'{{WRAPPER}} .gsap-bg-widget' => '--pink: {{VALUE}};',
				),
				'condition' => array(
					'enable_gradient_overlay' => 'yes',
				),
			)
		);

		$this->add_control(
			'gradient_yellow',
			array(
				'label'     => esc_html__( 'Yellow Glow', 'gsap-background' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'hsl(52, 100%, 50%)',
				'selectors' => array(
					'{{WRAPPER}} .gsap-bg-widget' => '--yellow: {{VALUE}};',
				),
				'condition' => array(
					'enable_gradient_overlay' => 'yes',
				),
			)
		);

		$this->add_control(
			'gradient_orange',
			array(
				'label'     => esc_html__( 'Orange Glow', 'gsap-background' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'hsl(20, 100%, 55%)',
				'selectors' => array(
					'{{WRAPPER}} .gsap-bg-widget' => '--orange: {{VALUE}};',
				),
				'condition' => array(
					'enable_gradient_overlay' => 'yes',
				),
			)
		);

		$this->add_control(
			'gradient_cyan',
			array(
				'label'     => esc_html__( 'Cyan Glow', 'gsap-background' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'hsl(185, 100%, 52%)',
				'selectors' => array(
					'{{WRAPPER}} .gsap-bg-widget' => '--cyan: {{VALUE}};',
				),
				'condition' => array(
					'enable_gradient_overlay' => 'yes',
				),
			)
		);

		$this->add_control(
			'gradient_base',
			array(
				'label'     => esc_html__( 'Base Color', 'gsap-background' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'hsl(48, 100%, 93%)',
				'selectors' => array(
					'{{WRAPPER}} .gsap-bg-widget' => '--cream: {{VALUE}};',
				),
				'condition' => array(
					'enable_gradient_overlay' => 'yes',
				),
			)
		);

		$this->add_control(
			'background_dark',
			array(
				'label'     => esc_html__( 'Fallback Background', 'gsap-background' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'hsl(20, 10%, 5%)',
				'selectors' => array(
					'{{WRAPPER}} .gsap-bg-widget' => '--dark: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'gradient_overlay_opacity',
			array(
				'label'      => esc_html__( 'Overlay Opacity', 'gsap-background' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.01,
					),
				),
				'default'    => array(
					'size' => 0.55,
				),
				'selectors'  => array(
					'{{WRAPPER}} .gsap-bg-widget' => '--gradient-overlay-opacity: {{SIZE}};',
				),
				'condition'  => array(
					'enable_gradient_overlay' => 'yes',
				),
			)
		);

		$this->add_control(
			'gradient_blend_mode',
			array(
				'label'     => esc_html__( 'Blend Mode', 'gsap-background' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'soft-light',
				'options'   => array(
					'normal'      => esc_html__( 'Normal', 'gsap-background' ),
					'multiply'    => esc_html__( 'Multiply', 'gsap-background' ),
					'screen'      => esc_html__( 'Screen', 'gsap-background' ),
					'overlay'     => esc_html__( 'Overlay', 'gsap-background' ),
					'soft-light'  => esc_html__( 'Soft Light', 'gsap-background' ),
					'hard-light'  => esc_html__( 'Hard Light', 'gsap-background' ),
					'color-dodge' => esc_html__( 'Color Dodge', 'gsap-background' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .gsap-bg-widget' => '--gradient-overlay-blend: {{VALUE}};',
				),
				'condition' => array(
					'enable_gradient_overlay' => 'yes',
				),
			)
		);

		$this->add_control(
			'atmosphere_heading',
			array(
				'label'     => esc_html__( 'Atmosphere Effects', 'gsap-background' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'effect_preset',
			array(
				'label'   => esc_html__( 'Effect Preset', 'gsap-background' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'clouds_mist',
				'options' => array(
					'none'          => esc_html__( 'None', 'gsap-background' ),
					'clouds_mist'   => esc_html__( 'Clouds + Mist', 'gsap-background' ),
					'snow'          => esc_html__( 'Snow', 'gsap-background' ),
					'rain'          => esc_html__( 'Rain', 'gsap-background' ),
					'light_rays'    => esc_html__( 'Light Rays', 'gsap-background' ),
					'particles'     => esc_html__( 'Particles', 'gsap-background' ),
					'neon_glitch'   => esc_html__( 'Neon/Glitch', 'gsap-background' ),
					'heat_haze'     => esc_html__( 'Heat Haze', 'gsap-background' ),
					'fireflies'     => esc_html__( 'Fireflies', 'gsap-background' ),
					'ocean_shimmer' => esc_html__( 'Ocean Shimmer', 'gsap-background' ),
				),
			)
		);

		$this->add_control(
			'effect_opacity',
			array(
				'label'      => esc_html__( 'Effect Opacity', 'gsap-background' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.01,
					),
				),
				'default'    => array(
					'size' => 0.55,
				),
				'selectors'  => array(
					'{{WRAPPER}} .gsap-bg-widget' => '--effect-opacity: {{SIZE}};',
				),
				'condition'  => array(
					'effect_preset!' => 'none',
				),
			)
		);

		$this->add_control(
			'effect_speed',
			array(
				'label'      => esc_html__( 'Effect Speed', 'gsap-background' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 10,
						'max'  => 80,
						'step' => 1,
					),
				),
				'default'    => array(
					'size' => 32,
				),
				'selectors'  => array(
					'{{WRAPPER}} .gsap-bg-widget' => '--effect-speed: {{SIZE}};',
				),
				'condition'  => array(
					'effect_preset!' => 'none',
				),
			)
		);

		$this->add_control(
			'effect_intensity',
			array(
				'label'      => esc_html__( 'Effect Intensity', 'gsap-background' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'size' => 70,
				),
				'selectors'  => array(
					'{{WRAPPER}} .gsap-bg-widget' => '--effect-intensity: {{SIZE}};',
				),
				'condition'  => array(
					'effect_preset!' => 'none',
				),
			)
		);

		$this->add_control(
			'effect_color',
			array(
				'label'     => esc_html__( 'Effect Color', 'gsap-background' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .gsap-bg-widget' => '--effect-color: {{VALUE}};',
				),
				'condition' => array(
					'effect_preset' => array( 'snow', 'rain', 'particles', 'fireflies' ),
				),
			)
		);

		$this->add_control(
			'rain_angle',
			array(
				'label'      => esc_html__( 'Rain Angle', 'gsap-background' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => -35,
						'max'  => 35,
						'step' => 1,
					),
				),
				'default'    => array(
					'size' => 12,
				),
				'selectors'  => array(
					'{{WRAPPER}} .gsap-bg-widget' => '--rain-angle: {{SIZE}}deg;',
				),
				'condition'  => array(
					'effect_preset' => 'rain',
				),
			)
		);

		$this->add_control(
			'snow_size',
			array(
				'label'      => esc_html__( 'Snow Size', 'gsap-background' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 2,
						'max'  => 14,
						'step' => 1,
					),
				),
				'default'    => array(
					'size' => 7,
				),
				'selectors'  => array(
					'{{WRAPPER}} .gsap-bg-widget' => '--snow-size: {{SIZE}}px;',
				),
				'condition'  => array(
					'effect_preset' => 'snow',
				),
			)
		);

		$this->add_control(
			'decor_heading',
			array(
				'label'     => esc_html__( 'Decor Elements', 'gsap-background' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'show_frame',
			array(
				'label'        => esc_html__( 'Show Frame Corners', 'gsap-background' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'gsap-background' ),
				'label_off'    => esc_html__( 'Hide', 'gsap-background' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'line_1_heading',
			array(
				'label'     => esc_html__( 'Heading Line 1', 'gsap-background' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'line_1_color',
			array(
				'label'     => esc_html__( 'Color', 'gsap-background' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'hsl(52, 100%, 50%)',
				'selectors' => array(
					'{{WRAPPER}} .gsap-bg-row-a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'line_1_typography',
				'selector' => '{{WRAPPER}} .gsap-bg-row-a',
			)
		);

		$this->add_control(
			'line_2_heading',
			array(
				'label'     => esc_html__( 'Heading Line 2', 'gsap-background' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'line_2_color',
			array(
				'label'     => esc_html__( 'Color', 'gsap-background' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'hsl(52, 100%, 50%)',
				'selectors' => array(
					'{{WRAPPER}} .gsap-bg-row-b' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'line_2_typography',
				'selector' => '{{WRAPPER}} .gsap-bg-row-b',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Keep user-provided positioning declarations narrowly constrained.
	 *
	 * @param string $position Position declaration string.
	 * @return string
	 */
	private function sanitize_position_style( $position ) {
		$allowed = array( 'top', 'right', 'bottom', 'left' );
		$parts   = array();

		foreach ( explode( ';', (string) $position ) as $declaration ) {
			$pair = explode( ':', $declaration, 2 );

			if ( 2 !== count( $pair ) ) {
				continue;
			}

			$property = trim( strtolower( $pair[0] ) );
			$value    = trim( $pair[1] );

			if ( ! in_array( $property, $allowed, true ) ) {
				continue;
			}

			if ( ! preg_match( '/^-?\d+(\.\d+)?(px|%|rem|em|vh|vw)$/', $value ) ) {
				continue;
			}

			$parts[] = $property . ':' . $value;
		}

		return implode( ';', $parts );
	}

	/**
	 * Sanitize slider size output.
	 *
	 * @param array $size Size control value.
	 * @return string
	 */
	private function sanitize_size_style( $size ) {
		if ( empty( $size['size'] ) || empty( $size['unit'] ) ) {
			return '';
		}

		$unit = in_array( $size['unit'], array( 'px', 'rem' ), true ) ? $size['unit'] : 'px';

		return abs( (float) $size['size'] ) . $unit;
	}

	/**
	 * Render widget output.
	 */
	protected function render() {
		$settings      = $this->get_settings_for_display();
		$valid_presets = array( 'none', 'clouds_mist', 'snow', 'rain', 'light_rays', 'particles', 'neon_glitch', 'heat_haze', 'fireflies', 'ocean_shimmer' );
		$hero_image    = ! empty( $settings['hero_image']['url'] ) ? $settings['hero_image']['url'] : GSAP_BACKGROUND_URL . 'images/background.jpg';
		$hero_alt      = ! empty( $settings['hero_image_alt'] ) ? $settings['hero_image_alt'] : esc_html__( 'hero', 'gsap-background' );
		$title_1       = ! empty( $settings['title_line_1'] ) ? $settings['title_line_1'] : esc_html__( 'ALPINE', 'gsap-background' );
		$title_2       = ! empty( $settings['title_line_2'] ) ? $settings['title_line_2'] : esc_html__( 'ESCAPE', 'gsap-background' );
		$preset        = ! empty( $settings['effect_preset'] ) && in_array( $settings['effect_preset'], $valid_presets, true ) ? $settings['effect_preset'] : 'clouds_mist';
		$show_gradient = ! isset( $settings['enable_gradient_overlay'] ) || 'yes' === $settings['enable_gradient_overlay'];
		$show_frame    = ! isset( $settings['show_frame'] ) || 'yes' === $settings['show_frame'];
		$show_stars    = ! isset( $settings['show_stars'] ) || 'yes' === $settings['show_stars'];
		$stars         = ! empty( $settings['stars'] ) && is_array( $settings['stars'] ) ? $settings['stars'] : array();
		$classes       = array( 'gsap-bg-widget', 'gsap-bg-effect-' . sanitize_html_class( $preset ) );

		if ( ! $show_gradient ) {
			$classes[] = 'gsap-bg-no-gradient';
		}

		if ( ! $show_frame ) {
			$classes[] = 'gsap-bg-no-frame';
		}

		if ( ! $show_stars ) {
			$classes[] = 'gsap-bg-no-stars';
		}

		$widget_id  = 'gsap-bg-' . $this->get_id();
		?>
		<div id="<?php echo esc_attr( $widget_id ); ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" data-effect-preset="<?php echo esc_attr( $preset ); ?>">
			<div class="gsap-bg-cursor"></div>
			<div class="gsap-bg-cursor-ring"></div>

			<div class="gsap-bg-wrapper">
				<div class="gsap-bg-plasma"></div>

				<div class="gsap-bg-image-container">
					<?php if ( $hero_image ) : ?>
						<img class="gsap-bg-hero-img" src="<?php echo esc_url( $hero_image ); ?>" alt="<?php echo esc_attr( $hero_alt ); ?>">
					<?php endif; ?>
					<?php if ( 'clouds_mist' === $preset ) : ?>
						<div class="gsap-bg-clouds" aria-hidden="true">
							<span class="gsap-bg-cloud gsap-bg-cloud-a"></span>
							<span class="gsap-bg-cloud gsap-bg-cloud-b"></span>
							<span class="gsap-bg-cloud gsap-bg-cloud-c"></span>
						</div>
						<div class="gsap-bg-valley-mist" aria-hidden="true"></div>
					<?php endif; ?>
					<?php if ( 'snow' === $preset ) : ?>
						<div class="gsap-bg-snow" aria-hidden="true">
							<?php for ( $i = 0; $i < 28; $i++ ) : ?>
								<span class="gsap-bg-snowflake"></span>
							<?php endfor; ?>
						</div>
					<?php endif; ?>
					<?php if ( 'rain' === $preset ) : ?>
						<div class="gsap-bg-rain" aria-hidden="true">
							<?php for ( $i = 0; $i < 36; $i++ ) : ?>
								<span class="gsap-bg-raindrop"></span>
							<?php endfor; ?>
						</div>
					<?php endif; ?>
					<?php if ( 'light_rays' === $preset ) : ?>
						<div class="gsap-bg-light-rays" aria-hidden="true">
							<span></span>
							<span></span>
							<span></span>
						</div>
					<?php endif; ?>
					<?php if ( 'particles' === $preset ) : ?>
						<div class="gsap-bg-particles" aria-hidden="true">
							<?php for ( $i = 0; $i < 30; $i++ ) : ?>
								<span class="gsap-bg-particle"></span>
							<?php endfor; ?>
						</div>
					<?php endif; ?>
					<?php if ( 'neon_glitch' === $preset ) : ?>
						<div class="gsap-bg-neon-glitch" aria-hidden="true"></div>
					<?php endif; ?>
					<?php if ( 'heat_haze' === $preset ) : ?>
						<div class="gsap-bg-heat-haze" aria-hidden="true"></div>
					<?php endif; ?>
					<?php if ( 'fireflies' === $preset ) : ?>
						<div class="gsap-bg-fireflies" aria-hidden="true">
							<?php for ( $i = 0; $i < 22; $i++ ) : ?>
								<span class="gsap-bg-firefly"></span>
							<?php endfor; ?>
						</div>
					<?php endif; ?>
					<?php if ( 'ocean_shimmer' === $preset ) : ?>
						<div class="gsap-bg-ocean-shimmer" aria-hidden="true"></div>
					<?php endif; ?>
				</div>

				<div class="gsap-bg-scanlines"></div>

				<?php if ( $show_frame ) : ?>
					<div class="gsap-bg-brackets">
						<div class="gsap-bg-bracket gsap-bg-bracket-tl"></div>
						<div class="gsap-bg-bracket gsap-bg-bracket-tr"></div>
						<div class="gsap-bg-bracket gsap-bg-bracket-bl"></div>
						<div class="gsap-bg-bracket gsap-bg-bracket-br"></div>
					</div>
				<?php endif; ?>

				<div class="gsap-bg-hero-overlay">
					<div class="gsap-bg-hero-title">
						<div class="gsap-bg-row"><span class="gsap-bg-row-a" data-text="<?php echo esc_attr( $title_1 ); ?>"><?php echo esc_html( $title_1 ); ?></span></div>
						<div class="gsap-bg-row"><span class="gsap-bg-row-b" data-text="<?php echo esc_attr( $title_2 ); ?>"><?php echo esc_html( $title_2 ); ?></span></div>
					</div>
				</div>

				<?php if ( $show_stars ) : ?>
					<?php foreach ( $stars as $index => $star ) : ?>
						<?php
						$position_style = $this->sanitize_position_style( isset( $star['position'] ) ? $star['position'] : '' );
						$star_size      = $this->sanitize_size_style( isset( $star['size'] ) ? $star['size'] : array() );
						$star_color     = sanitize_hex_color( isset( $star['color'] ) ? $star['color'] : '' );
						$star_symbol    = isset( $star['symbol'] ) && '' !== $star['symbol'] ? $star['symbol'] : '*';
						$star_style     = $position_style;

						if ( $star_color ) {
							$star_style .= ';color:' . $star_color;
						}

						if ( $star_size ) {
							$star_style .= ';font-size:' . $star_size;
						}
						?>
						<div class="gsap-bg-deco-star" style="<?php echo esc_attr( $star_style ); ?>" data-star-index="<?php echo esc_attr( $index ); ?>"><?php echo esc_html( $star_symbol ); ?></div>
					<?php endforeach; ?>
				<?php endif; ?>

			</div>
		</div>
		<?php
	}
}
