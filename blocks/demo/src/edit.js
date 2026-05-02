import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function Edit({ attributes, setAttributes }) {
    const { title, subtitle } = attributes;

    return (
        <div {...useBlockProps()}>
            <RichText
                tagName="h1"
                value={title}
                onChange={(value) => setAttributes({ title: value })}
                placeholder="Hero Title"
            />
            <RichText
                tagName="p"
                value={subtitle}
                onChange={(value) => setAttributes({ subtitle: value })}
                placeholder="Hero Subtitle"
            />
        </div>
    );
}