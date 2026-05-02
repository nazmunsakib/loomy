import { 
    useBlockProps, 
    RichText, 
    MediaUpload, 
    MediaUploadCheck, 
    InspectorControls 
} from '@wordpress/block-editor';
import { 
    Button, 
    PanelBody, 
    TextControl, 
    ToolbarGroup, 
    ToolbarButton 
} from '@wordpress/components';
import { __ } from '@wordpress/i18n';

export default function Edit({ attributes, setAttributes }) {
    const { 
        title, 
        description, 
        bgImageUrl, 
        bgImageId, 
        primaryBtnText, 
        primaryBtnLink, 
        secondaryBtnText, 
        secondaryBtnLink 
    } = attributes;

    const onSelectImage = (media) => {
        setAttributes({ 
            bgImageUrl: media.url, 
            bgImageId: media.id 
        });
    };

    const removeImage = () => {
        setAttributes({ 
            bgImageUrl: null, 
            bgImageId: null 
        });
    };

    return (
        <>
            <InspectorControls>
                <PanelBody title={__('Background Image', 'loomy')}>
                    <MediaUploadCheck>
                        <MediaUpload
                            onSelect={onSelectImage}
                            allowedTypes={['image']}
                            value={bgImageId}
                            render={({ open }) => (
                                <Button 
                                    className={!bgImageId ? 'editor-post-featured-image__toggle' : 'editor-post-featured-image__preview'}
                                    onClick={open}
                                >
                                    {!bgImageId ? __('Select Image', 'loomy') : <img src={bgImageUrl} alt="" />}
                                </Button>
                            )}
                        />
                    </MediaUploadCheck>
                    {bgImageId && (
                        <Button onClick={removeImage} isDestructive variant="link">
                            {__('Remove Image', 'loomy')}
                        </Button>
                    )}
                </PanelBody>
                <PanelBody title={__('Buttons', 'loomy')}>
                    <TextControl
                        label={__('Primary Button Text', 'loomy')}
                        value={primaryBtnText}
                        onChange={(val) => setAttributes({ primaryBtnText: val })}
                    />
                    <TextControl
                        label={__('Primary Button Link', 'loomy')}
                        value={primaryBtnLink}
                        onChange={(val) => setAttributes({ primaryBtnLink: val })}
                    />
                    <hr />
                    <TextControl
                        label={__('Secondary Button Text', 'loomy')}
                        value={secondaryBtnText}
                        onChange={(val) => setAttributes({ secondaryBtnText: val })}
                    />
                    <TextControl
                        label={__('Secondary Button Link', 'loomy')}
                        value={secondaryBtnLink}
                        onChange={(val) => setAttributes({ secondaryBtnLink: val })}
                    />
                </PanelBody>
            </InspectorControls>

            <section {...useBlockProps({
                className: 'loomy-hero-editor relative min-h-[600px] flex items-center justify-center overflow-hidden bg-black text-white p-12 text-center',
                style: {
                    backgroundImage: bgImageUrl ? `linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url(${bgImageUrl})` : 'none',
                    backgroundSize: 'cover',
                    backgroundPosition: 'center'
                }
            })}>
                <div className="relative z-10 max-w-4xl mx-auto">
                    <RichText
                        tagName="h1"
                        value={title}
                        onChange={(val) => setAttributes({ title: val })}
                        className="text-5xl md:text-7xl font-bold mb-6 tracking-tight"
                        placeholder={__('Enter Title...', 'loomy')}
                    />
                    <RichText
                        tagName="p"
                        value={description}
                        onChange={(val) => setAttributes({ description: val })}
                        className="text-xl md:text-2xl opacity-80 mb-10 max-w-2xl mx-auto leading-relaxed"
                        placeholder={__('Enter Description...', 'loomy')}
                    />
                    <div className="flex flex-wrap justify-center gap-4">
                        <span className="inline-block px-8 py-4 bg-white text-black font-bold rounded-full">
                            {primaryBtnText}
                        </span>
                        <span className="inline-block px-8 py-4 border-2 border-white text-white font-bold rounded-full">
                            {secondaryBtnText}
                        </span>
                    </div>
                </div>
            </section>
        </>
    );
}
