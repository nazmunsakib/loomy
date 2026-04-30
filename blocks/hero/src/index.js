/**
 * Loomy Hero Block
 * 
 * Demonstrates GSAP integration with React/Gutenberg.
 */

import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, RichText } from '@wordpress/block-editor';
import { useEffect, useRef } from '@wordpress/element';
import gsap from 'gsap';

registerBlockType('loomy/hero', {
    apiVersion: 2,
    title: 'Loomy Hero',
    icon: 'cover-image',
    category: 'layout',
    attributes: {
        title: { type: 'string', source: 'html', selector: 'h1' },
    },
    edit: function Edit({ attributes, setAttributes }) {
        const blockProps = useBlockProps();
        const rootRef = useRef(null);

        useEffect(() => {
            // --- 1. Accessibility Guard ---
            const isReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            if (isReducedMotion) return;

            // --- 2. Editor Isolation ---
            // We only want subtle animations in the editor, or none at all.
            // Constraint: "NEVER run GSAP inside .block-editor-iframe__body"
            const isEditor = document.body.classList.contains('wp-admin');
            if (isEditor) return;

            // --- 3. Scoped GSAP Context ---
            const ctx = gsap.context(() => {
                gsap.from('.hero-title', {
                    y: 20,
                    opacity: 0,
                    duration: 0.8,
                    ease: 'power2.out',
                });
            }, rootRef);

            // --- 4. Cleanup ---
            return () => ctx.revert();
        }, []);

        return (
            <div { ...blockProps } ref={rootRef} className="loomy-hero-block">
                <RichText
                    tagName="h1"
                    className="hero-title"
                    value={ attributes.title }
                    onChange={ ( title ) => setAttributes( { title } ) }
                    placeholder="Enter Hero Title..."
                />
            </div>
        );
    },
    save: function ({ attributes }) {
        const blockProps = useBlockProps.save();
        return (
            <div { ...blockProps } className="loomy-hero-block">
                <RichText.Content
                    tagName="h1"
                    className="hero-title loomy-animate-on-scroll"
                    data-animation="fade-up"
                    value={ attributes.title }
                />
            </div>
        );
    },
});
