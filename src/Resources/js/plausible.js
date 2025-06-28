import React from 'react';
import {viewRegistry} from 'sulu-admin-bundle/containers';
import {translate} from 'sulu-admin-bundle/utils';

class PlausibleStats extends React.Component {
    render() {
        const route = this.props.route || {};
        const options = route.options || {};
        const domain = options.domain || 'votre-domaine.com';
        const baseUrl = options.baseUrl || 'https://plausible.io';
        const authKey = options.authKey || '';
        
        if (!domain || domain === 'votre-domaine.com') {
            return (
                <div style={{
                    padding: '40px',
                    textAlign: 'center',
                    color: '#dc3545',
                    fontSize: '16px'
                }}>
                    <h3>{translate('plausible.configuration_missing')}</h3>
                    <p>{translate('plausible.domain_not_configured')}</p>
                    <p style={{
                        fontSize: '14px',
                        color: '#6c757d',
                        marginTop: '20px'
                    }}>
                        {translate('plausible.check_env_variable')}
                    </p>
                </div>
            );
        }

        const iframeUrl = `${baseUrl}/share/${domain}?auth=${authKey}&embed=true&theme=light&background=transparent`;

        return (
            <div style={{
                padding: '20px',
                backgroundColor: '#fff',
                minHeight: '100vh'
            }}>
                <div style={{
                    marginBottom: '20px',
                    paddingBottom: '20px',
                    borderBottom: '1px solid #e5e7eb'
                }}>
                    <h1 style={{
                        margin: '0',
                        fontSize: '24px',
                        fontWeight: '600',
                        color: '#111827'
                    }}>
{translate('plausible.statistics')}
                    </h1>
                    <p style={{
                        margin: '5px 0 0 0',
                        color: '#6b7280',
                        fontSize: '14px'
                    }}>
{translate('plausible.domain')}: {domain}
                    </p>
                </div>
                
                <div style={{
                    boxShadow: '0 1px 3px rgba(0, 0, 0, 0.1)',
                    borderRadius: '4px',
                    overflow: 'hidden'
                }}>
                    <iframe
                        src={iframeUrl}
                        width="100%"
                        height="800"
                        style={{
                            border: 'none',
                            display: 'block'
                        }}
                        title={translate('plausible.statistics_for', {domain})}
                    />
                </div>
            </div>
        );
    }
}

viewRegistry.add('app.plausible_stats', PlausibleStats);