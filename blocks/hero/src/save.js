import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save({ attributes }) {
    const { 
        title, 
        description, 
        bgImageUrl, 
        primaryBtnText, 
        primaryBtnLink, 
        secondaryBtnText, 
        secondaryBtnLink 
    } = attributes;

    const sectionStyle = bgImageUrl ? {
        backgroundImage: `linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url(${bgImageUrl})`,
        backgroundSize: 'cover',
        backgroundPosition: 'center'
    } : {
        backgroundColor: '#000'
    };

    return (
        <section {...useBlockProps.save({
            className: 'loomy-hero relative min-h-screen flex items-center justify-center overflow-hidden text-white py-20 px-6',
            style: sectionStyle
        })}>
            {/* Background Decorative Element */}
            <div className="absolute top-0 left-0 w-full h-full pointer-events-none opacity-30">
                <div className="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-primary rounded-full blur-[120px] mix-blend-screen"></div>
                <div className="absolute -bottom-[10%] -right-[10%] w-[40%] h-[40%] bg-secondary rounded-full blur-[120px] mix-blend-screen"></div>
            </div>

            <div className="relative z-10 max-w-5xl mx-auto text-center">
                <div className="hero-content-reveal overflow-hidden">
                    <RichText.Content
                        tagName="h1"
                        value={title}
                        className="text-5xl md:text-8xl font-black mb-8 tracking-tighter leading-[0.9] hero-title"
                    />
                </div>
                
                <div className="hero-content-reveal overflow-hidden">
                    <RichText.Content
                        tagName="p"
                        value={description}
                        className="text-lg md:text-2xl text-gray-300 mb-12 max-w-2xl mx-auto hero-description"
                    />
                </div>

                <div className="flex flex-wrap justify-center gap-6 hero-buttons">
                    {primaryBtnText && (
                        <a 
                            href={primaryBtnLink} 
                            className="group relative inline-flex items-center justify-center px-10 py-5 font-bold text-black transition-all duration-300 bg-white rounded-full hover:bg-transparent hover:text-white border-2 border-white overflow-hidden"
                        >
                            <span className="relative z-10">{primaryBtnText}</span>
                        </a>
                    )}
                    {secondaryBtnText && (
                        <a 
                            href={secondaryBtnLink} 
                            className="inline-flex items-center justify-center px-10 py-5 font-bold text-white transition-all duration-300 border-2 border-white/30 rounded-full hover:border-white hover:bg-white/10"
                        >
                            {secondaryBtnText}
                        </a>
                    )}
                </div>
            </div>
        </section>
    );
}
