<?php
namespace Elementor;

class Elementor_Timeline_Slider_Widget extends Widget_Base {

    public function get_name() {
        return 'timeline_slider';
    }

    public function get_title() {
        return __( 'Timeline Slider', 'timeline-slider' );
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    protected function register_controls() {

        // Section to add timeline items
        $this->start_controls_section( 'content_section', [
            'label' => __( 'Timeline Items', 'timeline-slider' ),
        ] );

        $repeater = new Repeater();

        $repeater->add_control( 'year', [
            'label' => __( 'Year', 'timeline-slider' ),
            'type' => Controls_Manager::TEXT,
            'default' => __( '1996', 'timeline-slider' ),
        ] );

        $repeater->add_control( 'description', [
            'label' => __( 'Description', 'timeline-slider' ),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __( 'Timeline description here.', 'timeline-slider' ),
        ] );

        $this->add_control( 'timeline_list', [
            'label' => __( 'Timeline Items', 'timeline-slider' ),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ year }}}',
        ] );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

        <div class="cts-timeline-slider">
            <div class="cts-slider">
                <?php foreach ( $settings['timeline_list'] as $item ) : ?>
                    <div class="cts-slide">
                        <div class="cts-year"><?php echo esc_html( $item['year'] ); ?></div>
                        <div class="cts-description"><?php echo esc_html( $item['description'] ); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php
    }
}
