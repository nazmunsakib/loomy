import { 
    useBlockProps, 
    RichText, 
    MediaUpload, 
    MediaUploadCheck, 
    InspectorControls,
    ColorPalette
} from '@wordpress/block-editor';
import { 
    Button, 
    PanelBody, 
    TextControl, 
    RangeControl,
    TabPanel,
    Popover,
    ColorIndicator
} from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { useState } from '@wordpress/element';

/**
 * A Compact Color Picker Component
 */
const CompactColorPicker = ({ label, value, onChange }) => {
    const [ isOpen, setIsOpen ] = useState( false );
    const toggleVisible = () => setIsOpen( ( prev ) => ! prev );

    return (
        <div className="loomy-compact-color-control flex items-center justify-between mb-4">
            <span className="text-sm text-gray-700 font-medium">{label}</span>
            <div className="relative flex items-center">
                <Button 
                    onClick={toggleVisible} 
                    className="p-1 border border-gray-200 rounded-md bg-white hover:bg-gray-50 flex items-center gap-2"
                >
                    <ColorIndicator colorValue={value} />
                    <span className="text-xs text-gray-500 font-mono uppercase">{value || '#000'}</span>
                </Button>
                {isOpen && (
                    <Popover position="bottom left" onClose={() => setIsOpen(false)}>
                        <div className="p-4 bg-white shadow-xl rounded-lg border border-gray-100">
                            <ColorPalette
                                value={value}
                                onChange={(val) => {
                                    onChange(val);
                                    // Keep it open for easier adjustment, or close if you prefer
                                }}
                            />
                        </div>
                    </Popover>
                )}
            </div>
        </div>
    );
};

export default function Edit({ attributes, setAttributes }) {
    const { 
        title = '', 
        description = '', 
        bgImageUrl = '', 
        bgImageId, 
        primaryBtnText = '', 
        primaryBtnLink = '', 
        secondaryBtnText = '', 
        secondaryBtnLink = '',
        overlayOpacity = 70,
        overlayColor = '#000000',
        paddingTop = 100,
        paddingBottom = 100,
        contentMaxWidth = 1000,
        titleFontSize = 80,
        titleColor = '#ffffff',
        descriptionColor = '#d1d5db',
        primaryBtnBgColor = '#ffffff',
        primaryBtnTextColor = '#000000',
        secondaryBtnBgColor = 'transparent',
        secondaryBtnTextColor = '#ffffff'
    } = attributes;

    const onSelectImage = (media) => {
        setAttributes({ bgImageUrl: media.url, bgImageId: media.id });
    };

    const removeImage = () => {
        setAttributes({ bgImageUrl: null, bgImageId: null });
    };

    const opacity = typeof overlayOpacity === 'number' ? overlayOpacity / 100 : 0.7;

    const blockProps = useBlockProps({
        className: 'loomy-hero-editor relative flex items-center justify-center overflow-hidden bg-black text-white text-center',
        style: {
            backgroundImage: bgImageUrl ? `linear-gradient(${overlayColor}${Math.round(opacity * 255).toString(16).padStart(2, '0')}, ${overlayColor}${Math.round(opacity * 255).toString(16).padStart(2, '0')}), url(${bgImageUrl})` : overlayColor,
            backgroundSize: 'cover',
            backgroundPosition: 'center',
            paddingTop: `${paddingTop}px`,
            paddingBottom: `${paddingBottom}px`,
            minHeight: '400px'
        }
    });

    return (
        <>
            <InspectorControls>
                <TabPanel
                    className="loomy-tab-panel"
                    activeClass="is-active"
                    tabs={[
                        { name: 'content', title: __('CONTENT', 'loomy') },
                        { name: 'style', title: __('STYLE', 'loomy') },
                    ]}
                >
                    {(tab) => (
                        <>
                            {tab.name === 'content' && (
                                <>
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
                                            <Button onClick={removeImage} isDestructive variant="link" className="mt-2">
                                                {__('Remove Image', 'loomy')}
                                            </Button>
                                        )}
                                    </PanelBody>

                                    <PanelBody title={__('Buttons Content', 'loomy')}>
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
                                        <hr className="my-4 border-gray-200" />
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
                                </>
                            )}
                            {tab.name === 'style' && (
                                <>
                                    <PanelBody title={__('Background & Overlay', 'loomy')}>
                                        <CompactColorPicker 
                                            label={__('Overlay Color', 'loomy')}
                                            value={overlayColor}
                                            onChange={(val) => setAttributes({ overlayColor: val })}
                                        />
                                        <RangeControl
                                            label={__('Opacity (%)', 'loomy')}
                                            value={overlayOpacity}
                                            onChange={(val) => setAttributes({ overlayOpacity: val })}
                                            min={0}
                                            max={100}
                                        />
                                    </PanelBody>

                                    <PanelBody title={__('Typography Styles', 'loomy')} initialOpen={false}>
                                        <RangeControl
                                            label={__('Title Font Size', 'loomy')}
                                            value={titleFontSize}
                                            onChange={(val) => setAttributes({ titleFontSize: val })}
                                            min={20}
                                            max={150}
                                        />
                                        <CompactColorPicker 
                                            label={__('Title Color', 'loomy')}
                                            value={titleColor}
                                            onChange={(val) => setAttributes({ titleColor: val })}
                                        />
                                        <CompactColorPicker 
                                            label={__('Description Color', 'loomy')}
                                            value={descriptionColor}
                                            onChange={(val) => setAttributes({ descriptionColor: val })}
                                        />
                                    </PanelBody>

                                    <PanelBody title={__('Primary Button Style', 'loomy')} initialOpen={false}>
                                        <CompactColorPicker 
                                            label={__('Background', 'loomy')}
                                            value={primaryBtnBgColor}
                                            onChange={(val) => setAttributes({ primaryBtnBgColor: val })}
                                        />
                                        <CompactColorPicker 
                                            label={__('Text Color', 'loomy')}
                                            value={primaryBtnTextColor}
                                            onChange={(val) => setAttributes({ primaryBtnTextColor: val })}
                                        />
                                    </PanelBody>

                                    <PanelBody title={__('Secondary Button Style', 'loomy')} initialOpen={false}>
                                        <CompactColorPicker 
                                            label={__('Background', 'loomy')}
                                            value={secondaryBtnBgColor}
                                            onChange={(val) => setAttributes({ secondaryBtnBgColor: val })}
                                        />
                                        <CompactColorPicker 
                                            label={__('Text Color', 'loomy')}
                                            value={secondaryBtnTextColor}
                                            onChange={(val) => setAttributes({ secondaryBtnTextColor: val })}
                                        />
                                    </PanelBody>

                                    <PanelBody title={__('Spacing & Layout', 'loomy')} initialOpen={false}>
                                        <RangeControl
                                            label={__('Padding Top', 'loomy')}
                                            value={paddingTop}
                                            onChange={(val) => setAttributes({ paddingTop: val })}
                                            min={0}
                                            max={300}
                                        />
                                        <RangeControl
                                            label={__('Padding Bottom', 'loomy')}
                                            value={paddingBottom}
                                            onChange={(val) => setAttributes({ paddingBottom: val })}
                                            min={0}
                                            max={300}
                                        />
                                        <RangeControl
                                            label={__('Content Max Width', 'loomy')}
                                            value={contentMaxWidth}
                                            onChange={(val) => setAttributes({ contentMaxWidth: val })}
                                            min={400}
                                            max={1600}
                                        />
                                    </PanelBody>
                                </>
                            )}
                        </>
                    )}
                </TabPanel>
            </InspectorControls>

            <section {...blockProps}>
                <div className="relative z-10 w-full px-6" style={{ maxWidth: `${contentMaxWidth}px`, margin: '0 auto' }}>
                    <RichText
                        tagName="h1"
                        value={title}
                        onChange={(val) => setAttributes({ title: val })}
                        className="font-bold mb-8 tracking-tighter leading-none"
                        style={{ fontSize: `${titleFontSize}px`, color: titleColor }}
                        placeholder={__('Enter Title...', 'loomy')}
                    />
                    <RichText
                        tagName="p"
                        value={description}
                        onChange={(val) => setAttributes({ description: val })}
                        className="text-xl md:text-2xl opacity-80 mb-12 leading-relaxed"
                        style={{ color: descriptionColor }}
                        placeholder={__('Enter Description...', 'loomy')}
                    />
                    <div className="flex flex-wrap justify-center gap-6">
                        {primaryBtnText && (
                            <span 
                                className="inline-block px-10 py-5 font-bold rounded-full"
                                style={{ backgroundColor: primaryBtnBgColor, color: primaryBtnTextColor }}
                            >
                                {primaryBtnText}
                            </span>
                        )}
                        {secondaryBtnText && (
                            <span 
                                className="inline-block px-10 py-5 border-2 font-bold rounded-full"
                                style={{ backgroundColor: secondaryBtnBgColor, color: secondaryBtnTextColor, borderColor: secondaryBtnTextColor }}
                            >
                                {secondaryBtnText}
                            </span>
                        )}
                    </div>
                </div>
            </section>
        </>
    );
}
