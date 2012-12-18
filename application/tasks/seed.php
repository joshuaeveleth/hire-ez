<?php

class Seed_Task {

  public function run() {

    // Create the base data.
    $this->base_data();
    $this->minimal_data();
    $project = Project::first();

    // Create a bunch more stuff, just for testin'.
    for ($i = 0; $i < 5; $i++) Factory::project($project->id);
    for ($i = 0; $i < 300; $i++) Factory::bid();
    for ($i = 0; $i < 50; $i++) Factory::vendor();
  }

  public function production() {
    return $this->base_data();
  }

  public function minimal() {
    $this->base_data();
    $this->minimal_data();
  }

  private function base_data() {

    return;
    // If the "Web Design" service already exists, assume this task has already been run and exit.
    // if (Service::where_name('RFP-EZ')->first()) return;

    // // Create services for vendor profiles
    // Service::create(array('name' => 'RFP-EZ', 'description' => ''));
    // Service::create(array('name' => 'Open Data', 'description' => ''));
    // Service::create(array('name' => 'Smithsonian Awesomeness', 'description' => ''));

  }

  private function minimal_data() {
    $faker = Faker\Factory::create();
    for ($i = 0; $i < 5; $i++) Factory::vendor();
    for ($i = 0; $i < 5; $i++) Factory::officer();

    // Create first project
    $project = new Project(array('title' => 'RFP-EZr',
                                     'agency' => 'Small Business Administration',
                                     'office' => 'Office of Innovation and Research',
                                     'body' => "Best. Project. EVER!",
                                     'proposals_due_at' => new \DateTime('12/31/2012')
                                     ));

    $project->save();


    // ...And give it to officer1
    $project->officers()->attach(Officer::first()->id, array('owner' => true));
  }

}