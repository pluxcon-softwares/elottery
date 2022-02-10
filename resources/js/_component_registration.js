import globalVue from 'vue';
import { upperCase } from 'lodash';
import { camelCase } from 'lodash';

// Component Registration
// Require in a base component context
const requireComponent = require.context(
    '.', false, /base-[\w-]+\.vue$/
);

requireComponent.keys().forEach(filename => {
    // Get component config
    const componentConfig = requireComponent(filename);

    // Get PascalCase name of component
    const componentName = upperCase(
        camelCase(filename.replace(/^\.\//, '').replace(/\.\w+$/, ''))
    );

    // Register component globally
    globalVue.component(componentName, componentConfig.default || componentConfig);
});
