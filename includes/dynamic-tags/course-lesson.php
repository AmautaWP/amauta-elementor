<?php

namespace Amautor\Dynamic_Tags;

use \Elementor\Core\DynamicTags\Tag as Elementor_Tag;
use \Elementor\Modules\DynamicTags\Module;

class Course_Lesson extends Elementor_Tag
{

	public function get_name()
	{
		return 'amauta-course-lesson';
	}

	public function get_title()
	{
		return __( 'Course Lesson', 'amautor' );
	}

    public function get_group()
	{
		return 'amauta';
	}

	public function get_categories()
	{
		return [ Module::TEXT_CATEGORY ];
	}
		
	public function render()
	{
        
	}
}