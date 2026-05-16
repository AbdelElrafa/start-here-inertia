import { createInertiaApp, type ResolvedComponent } from '@inertiajs/react';
import createServer from '@inertiajs/react/server';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import ReactDOMServer from 'react-dom/server';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const pages = import.meta.glob<{ default: ResolvedComponent }>(
    './pages/**/*.tsx',
);

createServer((page) =>
    createInertiaApp({
        page,
        render: ReactDOMServer.renderToString,
        title: (title) => (title ? `${title} - ${appName}` : appName),
        resolve: (name) =>
            resolvePageComponent<{ default: ResolvedComponent }>(
                `./pages/${name}.tsx`,
                pages,
            ).then((module) => module.default),
        setup: ({ App, props }) => {
            return <App {...props} />;
        },
    }),
);
