import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save({ attributes }) {
    const { 
        title, 
        description, 
        bgImageUrl, 
        primaryBtnText, 
        primaryBtnLink, 
        secondaryBtnText, 
        secondaryBtnLink,
        overlayOpacity,
        overlayColor = '#000000',
        paddingTop,
        paddingBottom,
        contentMaxWidth,
        titleFontSize,
        titleColor,
        descriptionColor,
        primaryBtnBgColor,
        primaryBtnTextColor,
        secondaryBtnBgColor,
        secondaryBtnTextColor
    } = attributes;

    // Helper to convert hex to rgba
    const hexToRgba = (hex, alpha) => {
        const r = parseInt(hex.slice(1, 3), 16);
        const g = parseInt(hex.slice(3, 5), 16);
        const b = parseInt(hex.slice(5, 7), 16);
        return `rgba(${r}, ${g}, ${b}, ${alpha})`;
    };

    const opacity = typeof overlayOpacity === 'number' ? overlayOpacity / 100 : 0.7;
    const rgbaOverlay = hexToRgba(overlayColor, opacity);

    const sectionStyle = {
        backgroundImage: bgImageUrl ? `linear-gradient(${rgbaOverlay}, ${rgbaOverlay}), url(${bgImageUrl})` : overlayColor,
        backgroundColor: overlayColor,
        backgroundSize: 'cover',
        backgroundPosition: 'center',
        paddingTop: `${paddingTop}px`,
        paddingBottom: `${paddingBottom}px`
    };

    return (
        <section {...useBlockProps.save({
            className: 'loomy-hero relative min-h-[70vh] flex items-center justify-center overflow-hidden text-white px-6',
            style: sectionStyle
        })}>
            {/* Background Decorative Element */}
            <div className="absolute top-0 left-0 w-full h-full pointer-events-none opacity-30">
                <div className="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-primary rounded-full blur-[120px] mix-blend-screen"></div>
                <div className="absolute -bottom-[10%] -right-[10%] w-[40%] h-[40%] bg-secondary rounded-full blur-[120px] mix-blend-screen"></div>
            </div>

            <div className="relative z-10 w-full text-center" style={{ maxWidth: `${contentMaxWidth}px` }}>
                <div className="hero-content-reveal overflow-hidden">
                    <RichText.Content
                        tagName="h1"
                        value={title}
                        className="font-black mb-8 tracking-tighter leading-[0.9] hero-title"
                        style={{ fontSize: `${titleFontSize}px`, color: titleColor }}
                    />
                </div>
                
                <div className="hero-content-reveal overflow-hidden">
                    <RichText.Content
                        tagName="p"
                        value={description}
                        className="text-lg md:text-2xl mb-12 max-w-2xl mx-auto hero-description leading-relaxed"
                        style={{ color: descriptionColor }}
                    />
                </div>

                <div className="flex flex-wrap justify-center gap-6 hero-buttons">
                    {primaryBtnText && (
                        <a 
                            href={primaryBtnLink} 
                            className="group relative inline-flex items-center justify-center px-10 py-5 font-bold transition-all duration-300 rounded-full hover:brightness-110 overflow-hidden"
                            style={{ backgroundColor: primaryBtnBgColor, color: primaryBtnTextColor }}
                        >
                            <span className="relative z-10">{primaryBtnText}</span>
                        </a>
                    )}
                    {secondaryBtnText && (
                        <a 
                            href={secondaryBtnLink} 
                            className="inline-flex items-center justify-center px-10 py-5 font-bold transition-all duration-300 border-2 rounded-full hover:bg-white/10"
                            style={{ backgroundColor: secondaryBtnBgColor, color: secondaryBtnTextColor, borderColor: secondaryBtnTextColor }}
                        >
                            {secondaryBtnText}
                        </a>
                    )}
                </div>
            </div>
        </section>
    );
}
