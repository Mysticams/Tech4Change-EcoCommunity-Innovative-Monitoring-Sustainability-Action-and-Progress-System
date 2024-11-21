<?php
class ProgressTracker {
    private $project;

    public function __construct($project) {
        $this->project = $project;
    }

    // Update the progress of a project
    public function updateProgress($id, $newProgress) {
        if ($newProgress < 0 || $newProgress > 100) {
            throw new Exception("Progress must be between 0 and 100");
        }
        return $this->project->update($id, null, null, $newProgress, 'progress');
    }
}
?>
