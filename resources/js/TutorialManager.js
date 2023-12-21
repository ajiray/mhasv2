import Shepherd from 'shepherd.js';

class TutorialManager {
    constructor() {
        this.tour = new Shepherd.Tour({
            defaultStepOptions: {
                classes: 'shepherd-theme-arrows',
            },
        });
    }

    addStep(step) {
        this.tour.addStep(step);
    }

    start() {
        this.tour.start();
    }
}

export default new TutorialManager();