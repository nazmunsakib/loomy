import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save({ attributes }) {
    const { title, subtitle } = attributes;

    return (
        <div {...useBlockProps.save()}>
            <RichText.Content tagName="h1" value={title} />
            <RichText.Content tagName="p" value={subtitle} />
        </div>
    );
}